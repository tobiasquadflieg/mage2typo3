<?php
namespace Graphodata\Mage2typo3\Controller;

use Graphodata\Mage2typo3\Domain\Repository\ShopRepository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
     * @param \Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository $importConfigurationRepository
     */
    public function injectImportConfigurationRepository(\Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository $importConfigurationRepository)
    {
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
     * @return void
     */
    public function editAction(\Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration)
    {
        $this->view->assign('importConfiguration', $importConfiguration);
    }

    /**
     * action update
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration
     * @return void
     */
    public function updateAction(\Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration)
    {
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
}
