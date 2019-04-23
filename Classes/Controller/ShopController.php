<?php
namespace Graphodata\Mage2typo3\Controller;


/***
 *
 * This file is part of the "Mage2Typo3" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Tobias Quadflieg <Quadflieg@graphodata.de>, Graphodata AG
 *
 ***/
/**
 * ShopController
 */
class ShopController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * shopRepository
     * 
     * @var \Graphodata\Mage2typo3\Domain\Repository\ShopRepository
     * @inject
     */
    protected $shopRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $shops = $this->shopRepository->findAll();
        $this->view->assign('shops', $shops);
    }

    /**
     * action show
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\Shop $shop
     * @return void
     */
    public function showAction(\Graphodata\Mage2typo3\Domain\Model\Shop $shop)
    {
        $this->view->assign('shop', $shop);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\Shop $newShop
     * @return void
     */
    public function createAction(\Graphodata\Mage2typo3\Domain\Model\Shop $newShop)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->shopRepository->add($newShop);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\Shop $shop
     * @ignorevalidation $shop
     * @return void
     */
    public function editAction(\Graphodata\Mage2typo3\Domain\Model\Shop $shop)
    {
        $this->view->assign('shop', $shop);
    }

    /**
     * action update
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\Shop $shop
     * @return void
     */
    public function updateAction(\Graphodata\Mage2typo3\Domain\Model\Shop $shop)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->shopRepository->update($shop);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\Shop $shop
     * @return void
     */
    public function deleteAction(\Graphodata\Mage2typo3\Domain\Model\Shop $shop)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->shopRepository->remove($shop);
        $this->redirect('list');
    }
}
