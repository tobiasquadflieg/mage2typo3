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
 * ProductCategoryController
 */
class ProductCategoryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * productCategoryRepository
     * 
     * @var \Graphodata\Mage2typo3\Domain\Repository\ProductCategoryRepository
     * @inject
     */
    protected $productCategoryRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $productCategories = $this->productCategoryRepository->findAll();
        $this->view->assign('productCategories', $productCategories);
    }

    /**
     * action show
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\ProductCategory $productCategory
     * @return void
     */
    public function showAction(\Graphodata\Mage2typo3\Domain\Model\ProductCategory $productCategory)
    {
        $this->view->assign('productCategory', $productCategory);
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
     * @param \Graphodata\Mage2typo3\Domain\Model\ProductCategory $newProductCategory
     * @return void
     */
    public function createAction(\Graphodata\Mage2typo3\Domain\Model\ProductCategory $newProductCategory)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productCategoryRepository->add($newProductCategory);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\ProductCategory $productCategory
     * @ignorevalidation $productCategory
     * @return void
     */
    public function editAction(\Graphodata\Mage2typo3\Domain\Model\ProductCategory $productCategory)
    {
        $this->view->assign('productCategory', $productCategory);
    }

    /**
     * action update
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\ProductCategory $productCategory
     * @return void
     */
    public function updateAction(\Graphodata\Mage2typo3\Domain\Model\ProductCategory $productCategory)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productCategoryRepository->update($productCategory);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\ProductCategory $productCategory
     * @return void
     */
    public function deleteAction(\Graphodata\Mage2typo3\Domain\Model\ProductCategory $productCategory)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productCategoryRepository->remove($productCategory);
        $this->redirect('list');
    }
}
