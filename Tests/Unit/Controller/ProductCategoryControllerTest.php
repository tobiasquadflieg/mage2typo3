<?php
namespace Graphodata\Mage2typo3\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Tobias Quadflieg <Quadflieg@graphodata.de>
 */
class ProductCategoryControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Graphodata\Mage2typo3\Controller\ProductCategoryController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Graphodata\Mage2typo3\Controller\ProductCategoryController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllProductCategoriesFromRepositoryAndAssignsThemToView()
    {

        $allProductCategories = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $productCategoryRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ProductCategoryRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $productCategoryRepository->expects(self::once())->method('findAll')->will(self::returnValue($allProductCategories));
        $this->inject($this->subject, 'productCategoryRepository', $productCategoryRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('productCategories', $allProductCategories);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenProductCategoryToView()
    {
        $productCategory = new \Graphodata\Mage2typo3\Domain\Model\ProductCategory();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('productCategory', $productCategory);

        $this->subject->showAction($productCategory);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenProductCategoryToProductCategoryRepository()
    {
        $productCategory = new \Graphodata\Mage2typo3\Domain\Model\ProductCategory();

        $productCategoryRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ProductCategoryRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $productCategoryRepository->expects(self::once())->method('add')->with($productCategory);
        $this->inject($this->subject, 'productCategoryRepository', $productCategoryRepository);

        $this->subject->createAction($productCategory);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenProductCategoryToView()
    {
        $productCategory = new \Graphodata\Mage2typo3\Domain\Model\ProductCategory();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('productCategory', $productCategory);

        $this->subject->editAction($productCategory);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenProductCategoryInProductCategoryRepository()
    {
        $productCategory = new \Graphodata\Mage2typo3\Domain\Model\ProductCategory();

        $productCategoryRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ProductCategoryRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $productCategoryRepository->expects(self::once())->method('update')->with($productCategory);
        $this->inject($this->subject, 'productCategoryRepository', $productCategoryRepository);

        $this->subject->updateAction($productCategory);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenProductCategoryFromProductCategoryRepository()
    {
        $productCategory = new \Graphodata\Mage2typo3\Domain\Model\ProductCategory();

        $productCategoryRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ProductCategoryRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $productCategoryRepository->expects(self::once())->method('remove')->with($productCategory);
        $this->inject($this->subject, 'productCategoryRepository', $productCategoryRepository);

        $this->subject->deleteAction($productCategory);
    }
}
