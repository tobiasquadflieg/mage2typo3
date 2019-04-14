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
 * ProductsController
 */
class ProductsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * productsRepository
     * 
     * @var \Graphodata\Mage2typo3\Domain\Repository\ProductsRepository
     * @inject
     */
    protected $productsRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $products = $this->productsRepository->findAll();
        $this->view->assign('products', $products);
    }

    /**
     * action show
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\Products $products
     * @return void
     */
    public function showAction(\Graphodata\Mage2typo3\Domain\Model\Products $products)
    {
        $this->view->assign('products', $products);
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
     * @param \Graphodata\Mage2typo3\Domain\Model\Products $newProducts
     * @return void
     */
    public function createAction(\Graphodata\Mage2typo3\Domain\Model\Products $newProducts)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productsRepository->add($newProducts);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\Products $products
     * @ignorevalidation $products
     * @return void
     */
    public function editAction(\Graphodata\Mage2typo3\Domain\Model\Products $products)
    {
        $this->view->assign('products', $products);
    }

    /**
     * action update
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\Products $products
     * @return void
     */
    public function updateAction(\Graphodata\Mage2typo3\Domain\Model\Products $products)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productsRepository->update($products);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\Products $products
     * @return void
     */
    public function deleteAction(\Graphodata\Mage2typo3\Domain\Model\Products $products)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productsRepository->remove($products);
        $this->redirect('list');
    }
}
