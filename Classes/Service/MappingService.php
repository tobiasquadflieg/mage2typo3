<?php


namespace Graphodata\Mage2typo3\Service;


use Graphodata\Mage2typo3\Domain\Model\FileReference;
use Graphodata\Mage2typo3\Domain\Model\Shop;
use Graphodata\Mage2typo3\Domain\Repository\ProductRepository;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Property\PropertyMapper;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationBuilder;

/**
 * Class MappingService
 *
 * @package Graphodata\Mage2typo3\Service
 */
class MappingService implements SingletonInterface
{
    /**
     * @var Shop $shop
     */
    protected $shop;

    /**
     * @var \TYPO3\CMS\Core\Resource\ResourceFactory $resourceFactory
     */
    protected $resourceFactory;
    /**
     * @var object|\TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager;
    /**
     * @var object|\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    protected $persistenceManager;

    /**
     * MappingService constructor.
     */
    public function __construct()
    {
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $this->resourceFactory = ResourceFactory::getInstance();
    }

    /**
     * @param                                          $className
     * @param array                                    $productstack
     * @param \Graphodata\Mage2typo3\Domain\Model\Shop $shop
     *
     * @throws \TYPO3\CMS\Extbase\Property\Exception
     */
    public function map($className, array $productstack, Shop $shop)
    {
        /** @var \TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration $mappingConfiguration */
        $mappingConfiguration = $this->objectManager->get(PropertyMappingConfigurationBuilder::class)->build();

        //Allow the Property productImage to be a ObjectStorage
        $mappingConfiguration->forProperty('productImage')->allowAllProperties();

        /** @var ProductRepository $productRepo */
        $productRepo = $this->objectManager->get(ProductRepository::class);
        $this->shop = $shop;

        foreach ($productstack as $product) {
            //create the mappingarray to map the incomming Magentoarray to a TYPO3 Model
            $product['productImage'] = self::getImages($product['media_gallery_entries']);
            $product['createdAt'] = new \DateTime($product['created_at']);
            $product['updatedAt'] = new \DateTime($product['updated_at']);
            unset($product['media_gallery_entries'], $product['created_at'], $product['updated_at']);

            //Check if the Product already exists if not create a new one
            $oldProduct = $productRepo->findBySku($product['sku'])->getFirst();
            if ($oldProduct) {
                $oldProduct->setUpdatedAt($product['updatedAt']);
                $oldProduct->setName($product['name']);
                $oldProduct->setPrice($product['price'] ?: 0);
                $oldProduct->setProductImage($this->getNewImageObjectStorage($product['productImage']));
                $productRepo->update($oldProduct);
            } else {
                /** @var \Graphodata\Mage2typo3\Domain\Model\Product $productModel */
                $productModel = $this->objectManager->get(PropertyMapper::class)->convert($product, $className,
                    $mappingConfiguration);
                $productRepo->add($productModel);
            }
        }
        //Push all in to the DB
        $this->persistenceManager->persistAll();

    }

    /**
     * @param array $mediaEntries
     *
     * @return array
     * @throws \TYPO3\CMS\Core\Resource\Exception\ExistingTargetFolderException
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderReadPermissionsException
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderWritePermissionsException
     */
    protected function getImages(array $mediaEntries): array
    {

        /** @var \TYPO3\CMS\Core\Resource\Folder $folderObj */
        $folderObj = $this->resourceFactory->getDefaultStorage()->getFolder('mage2typo3/import/');
        if (!$folderObj->hasFolder('images/')) {
            $folderObj->createFolder('images');
        }
        /** @var \TYPO3\CMS\Core\Resource\Folder $imageFolder */
        $imageFolder = $folderObj->getSubfolder('images');
        $imagesRefs = [];
        foreach ($mediaEntries as $media) {
            $filename = explode("/", $media['file']); // Get the fileName from the Image path String
            /** @var string $url hold the Magento 2 URL for the Image */

            $url = $this->shop->getUrl() . 'pub/media/catalog/product' . $media['file'];
            /** @var string $dest create the local destination path */

            $dest = Environment::getPublicPath() . '/' . $imageFolder->getPublicUrl() . $filename[3];
            file_put_contents($dest, file_get_contents($url)); //Download the Image

            /** @var File $file */
            $file = $this->resourceFactory->getFileObjectFromCombinedIdentifier($imageFolder->getPublicUrl() . $filename[3]);
            array_push($imagesRefs, $this->createFileReferenceFromFalFileObject($file));
        }
        return $imagesRefs;

    }

    protected function getNewImageObjectStorage(array $fileRefarray)
    {
        /** @var ObjectStorage $newObj */
        $newObj = new ObjectStorage();
        foreach ($fileRefarray as $fileRef) {
            $newObj->attach($fileRef);
        }
        return $newObj;
    }

    /**
     * @param \TYPO3\CMS\Core\Resource\File $file
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected function createFileReferenceFromFalFileObject(File $file)
    {
        $fileReference = $this->resourceFactory->createFileReferenceObject(
            [
                'uid_local' => $file->getUid(),
                'uid_foreign' => uniqid('NEW_'),
                'uid' => uniqid('NEW_'),
                'crop' => null,
            ]
        );
        return $this->createFileReferenceFromFalFileReferenceObject($fileReference);
    }

    protected function createFileReferenceFromFalFileReferenceObject(
        \TYPO3\CMS\Core\Resource\FileReference $falFileReference,
        $resourcePointer = null
    ) {
        if ($resourcePointer === null) {
            /** @var $fileReference FileReference */
            $fileReference = $this->objectManager->get(FileReference::class);
        } else {
            $fileReference = $this->persistenceManager->getObjectByIdentifier($resourcePointer,
                \TYPO3\CMS\Extbase\Domain\Model\FileReference::class, false);
        }
        $fileReference->setOriginalResource($falFileReference);
        return $fileReference;
    }
}