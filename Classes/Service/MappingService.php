<?php


namespace Graphodata\Mage2typo3\Service;


use Graphodata\Mage2typo3\Domain\Model\FileReference;
use Graphodata\Mage2typo3\Domain\Model\Product;
use Graphodata\Mage2typo3\Domain\Model\Shop;
use Graphodata\Mage2typo3\Domain\Repository\ProductRepository;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
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
        $mappingConfiguration = $this->objectManager->get(PropertyMappingConfigurationBuilder::class)->build();
        $mappingConfiguration->forProperty('productImage')->allowAllProperties();
        $productRepo = $this->objectManager->get(ProductRepository::class);
        $this->shop = $shop;
        foreach ($productstack as $product) {
            $product['productImage'] = self::getImages($product['media_gallery_entries']);
            $product['createdAt'] = $product['created_at'];
            $product['updatedAt'] = $product['updated_at'];
            unset($product['media_gallery_entries'], $product['created_at'], $product['updated_at']);
            $productModel = $this->objectManager->get(PropertyMapper::class)->convert($product, Product::class,
                $mappingConfiguration);
            $productRepo->add($productModel);
        }
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
        $folderObj = $this->resourceFactory->getDefaultStorage()->getFolder('mage2typo3/import/');
        if (!$folderObj->hasFolder('images/')) {
            $folderObj->createFolder('images');
        }
        $imageFolder = $folderObj->getSubfolder('images');
        $imagesRefs = [];
        foreach ($mediaEntries as $media) {
            $filename = explode("/", $media['file']);
            $url = $this->shop->getUrl() . 'pub/media/catalog/product' . $media['file'];
            $dest = Environment::getPublicPath() . '/' . $imageFolder->getPublicUrl() . $filename[3];
            file_put_contents($dest, file_get_contents($url));
            $file = $this->resourceFactory->getFileObjectFromCombinedIdentifier($imageFolder->getPublicUrl() . $filename[3]);
            array_push($imagesRefs, $this->createFileReferenceFromFalFileObject($file));
        }

        return $imagesRefs;

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