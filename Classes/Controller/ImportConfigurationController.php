<?php

namespace Graphodata\Mage2typo3\Controller;


use Graphodata\Mage2typo3\Command\ImportCommandController;
use Graphodata\Mage2typo3\Command\ImportProductCommand;
use Graphodata\Mage2typo3\Domain\Model\Product;
use Graphodata\Mage2typo3\Service\ApiService;
use Graphodata\Mage2typo3\Service\MappingService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Page\PageRepository;

/***
 * This file is part of the "Mage2Typo3" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *  (c) 2019 Tobias Quadflieg <Quadflieg@graphodata.de>, Graphodata AG
 ***/

/**
 * ImportConfigurationController
 */
class ImportConfigurationController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * importConfigurationRepository
     *
     * @var \Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository
     */
    protected $importConfigurationRepository = null;

    /**
     * shopRepository
     *
     * @var \Graphodata\Mage2typo3\Domain\Repository\ShopRepository
     */
    protected $shopRepository = null;

    /**
     * Import Command Controller
     *
     * @var \Graphodata\Mage2typo3\Command\ImportProductCommand
     */
    protected $importProductCommand = null;

    /**
     * Page Repository
     *
     * @var PageRepository
     */
    protected $pageRepository;

    /**
     * @param \Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository $importConfigurationRepository
     */
    public function injectImportConfigurationRepository(
        \Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository $importConfigurationRepository
    ) {
        $this->importConfigurationRepository = $importConfigurationRepository;
    }

    /**
     * @param \Graphodata\Mage2typo3\Domain\Repository\ShopRepository $shopRepository
     */
    public function injectShopRepository(\Graphodata\Mage2typo3\Domain\Repository\ShopRepository $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    /**
     * @param \Graphodata\Mage2typo3\Command\ImportProductCommand
     */
    public function injectImportCommandController(ImportProductCommand $importProductCommand)
    {
        $this->importProductCommand = $importProductCommand;
    }

    public function injectPageRepository(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    protected function initializeAction()
    {
        //Create the Import folder structure
        $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
        if (!$resourceFactory->getDefaultStorage()->hasFolder('mage2typo3/')) {
            $resourceFactory->getDefaultStorage()->createFolder('mage2typo3/');
            $parentFolder = $resourceFactory->getDefaultStorage()->getFolder('mage2typo3');
            $resourceFactory->getDefaultStorage()->createFolder('import', $parentFolder);
        }
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $importConfigurations = $this->importConfigurationRepository->findAll();
        $this->view->assign('importConfigurations', $importConfigurations);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        $shops = $this->shopRepository->findAll();
        $this->view->assign('shops', $shops);
    }

    /**
     * action create
     *
     * @param \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $newImportConfiguration
     *
     * @return void
     */
    public function createAction(\Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $newImportConfiguration)
    {
        $this->addFlashMessage(
            'The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );
        $this->importConfigurationRepository->add($newImportConfiguration);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration
     * @ignorevalidation $importConfiguration
     *
     * @return void
     */
    public function editAction(\Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration)
    {
        $shops = $this->shopRepository->findAll();
        $page = $this->pageRepository->getPage($importConfiguration->getStorageid());
        $this->view->assign('shops', $shops);
        $this->view->assign('importConfiguration', $importConfiguration);
        $this->view->assign('storagePage', $page);
    }

    /**
     * action update
     *
     * @param \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration
     *
     * @return void
     */
    public function updateAction(\Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration)
    {
        $shops = $this->shopRepository->findAll();
        $this->view->assign('shops', $shops);
        $this->addFlashMessage(
            'The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );
        $this->importConfigurationRepository->update($importConfiguration);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration
     *
     * @return void
     */
    public function deleteAction(\Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration)
    {
        $this->addFlashMessage(
            'The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );
        $this->importConfigurationRepository->remove($importConfiguration);
        $this->redirect('list');
    }

    /**
     * run delete
     *
     * @param \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration
     *
     * @return void
     */
    public function runAction(\Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration)
    {
        $this->addFlashMessage(
            'Run the Import for the selected Configuration, Imports all Products and Categories form the Shop',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO
        );
        $productArr = [];
        $apiService = GeneralUtility::makeInstance(ApiService::class, $importConfiguration);
        if ($apiService->getAuthToken()) {
            $productcount = $apiService->getProductsCount();
            $pages = ceil($productcount / 200);
            for ($i = 1; $i <= $pages; $i++) {
                array_push($productArr, $apiService->getProducts(200, $i));
            }
        }
        $mapping = GeneralUtility::makeInstance(MappingService::class);
        foreach ($productArr as $product) {
            $mapping->map(Product::class, $product, $importConfiguration->getShop());
            break;
        }
//        $productdetails = [];
//        foreach ($allproducts as $importProducts) {
//            foreach ($importProducts as $product) {
//                array_push($productdetails, $apiService->getProductdetails($product['sku']));
//            }
//        }

//        DebuggerUtility::var_dump($productdetails);
//        for ($i = 0; $i <= $maxItems; $i++) {
//            $this->view->assign('itemsfound', count($allproducts));
//        }
//        foreach ($allproducts as $product) {
//            DebuggerUtility::var_dump($apiService->getProductdetails($product->sku));
//        }

//        if ($response->getStatusCode() === 200) {
//            if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
//                $adminkey = $response->getBody()->getContents();
//            }
//        }
    }
}
