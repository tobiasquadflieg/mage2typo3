<?php
namespace Graphodata\Mage2typo3\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Tobias Quadflieg <Quadflieg@graphodata.de>
 */
class ProductCategoriesControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Graphodata\Mage2typo3\Controller\ProductCategoriesController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Graphodata\Mage2typo3\Controller\ProductCategoriesController::class)
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
    public function listActionFetchesAllProductCategoriessFromRepositoryAndAssignsThemToView()
    {

        $allProductCategoriess = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $productCategoriesRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ProductCategoriesRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $productCategoriesRepository->expects(self::once())->method('findAll')->will(self::returnValue($allProductCategoriess));
        $this->inject($this->subject, 'productCategoriesRepository', $productCategoriesRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('productCategoriess', $allProductCategoriess);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenProductCategoriesToView()
    {
        $productCategories = new \Graphodata\Mage2typo3\Domain\Model\ProductCategories();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('productCategories', $productCategories);

        $this->subject->showAction($productCategories);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenProductCategoriesToProductCategoriesRepository()
    {
        $productCategories = new \Graphodata\Mage2typo3\Domain\Model\ProductCategories();

        $productCategoriesRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ProductCategoriesRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $productCategoriesRepository->expects(self::once())->method('add')->with($productCategories);
        $this->inject($this->subject, 'productCategoriesRepository', $productCategoriesRepository);

        $this->subject->createAction($productCategories);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenProductCategoriesToView()
    {
        $productCategories = new \Graphodata\Mage2typo3\Domain\Model\ProductCategories();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('productCategories', $productCategories);

        $this->subject->editAction($productCategories);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenProductCategoriesInProductCategoriesRepository()
    {
        $productCategories = new \Graphodata\Mage2typo3\Domain\Model\ProductCategories();

        $productCategoriesRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ProductCategoriesRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $productCategoriesRepository->expects(self::once())->method('update')->with($productCategories);
        $this->inject($this->subject, 'productCategoriesRepository', $productCategoriesRepository);

        $this->subject->updateAction($productCategories);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenProductCategoriesFromProductCategoriesRepository()
    {
        $productCategories = new \Graphodata\Mage2typo3\Domain\Model\ProductCategories();

        $productCategoriesRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ProductCategoriesRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $productCategoriesRepository->expects(self::once())->method('remove')->with($productCategories);
        $this->inject($this->subject, 'productCategoriesRepository', $productCategoriesRepository);

        $this->subject->deleteAction($productCategories);
    }
}
