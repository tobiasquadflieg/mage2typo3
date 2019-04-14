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
 * ProductCategoriesController
 */
class ProductCategoriesController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * productCategoriesRepository
     * 
     * @var \Graphodata\Mage2typo3\Domain\Repository\ProductCategoriesRepository
     * @inject
     */
    protected $productCategoriesRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $productCategories = $this->productCategoriesRepository->findAll();
        $this->view->assign('productCategories', $productCategories);
    }

    /**
     * action show
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\ProductCategories $productCategories
     * @return void
     */
    public function showAction(\Graphodata\Mage2typo3\Domain\Model\ProductCategories $productCategories)
    {
        $this->view->assign('productCategories', $productCategories);
    }

    /**
     * action edit
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\ProductCategories $productCategories
     * @ignorevalidation $productCategories
     * @return void
     */
    public function editAction(\Graphodata\Mage2typo3\Domain\Model\ProductCategories $productCategories)
    {
        $this->view->assign('productCategories', $productCategories);
    }

    /**
     * action update
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\ProductCategories $productCategories
     * @return void
     */
    public function updateAction(\Graphodata\Mage2typo3\Domain\Model\ProductCategories $productCategories)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productCategoriesRepository->update($productCategories);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\ProductCategories $productCategories
     * @return void
     */
    public function deleteAction(\Graphodata\Mage2typo3\Domain\Model\ProductCategories $productCategories)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productCategoriesRepository->remove($productCategories);
        $this->redirect('list');
    }
}
