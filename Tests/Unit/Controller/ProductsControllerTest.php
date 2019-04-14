<?php
namespace Graphodata\Mage2typo3\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Tobias Quadflieg <Quadflieg@graphodata.de>
 */
class ProductsControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Graphodata\Mage2typo3\Controller\ProductsController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Graphodata\Mage2typo3\Controller\ProductsController::class)
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
    public function listActionFetchesAllProductssFromRepositoryAndAssignsThemToView()
    {

        $allProductss = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $productsRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ProductsRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $productsRepository->expects(self::once())->method('findAll')->will(self::returnValue($allProductss));
        $this->inject($this->subject, 'productsRepository', $productsRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('productss', $allProductss);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenProductsToView()
    {
        $products = new \Graphodata\Mage2typo3\Domain\Model\Products();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('products', $products);

        $this->subject->showAction($products);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenProductsToProductsRepository()
    {
        $products = new \Graphodata\Mage2typo3\Domain\Model\Products();

        $productsRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ProductsRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $productsRepository->expects(self::once())->method('add')->with($products);
        $this->inject($this->subject, 'productsRepository', $productsRepository);

        $this->subject->createAction($products);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenProductsToView()
    {
        $products = new \Graphodata\Mage2typo3\Domain\Model\Products();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('products', $products);

        $this->subject->editAction($products);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenProductsInProductsRepository()
    {
        $products = new \Graphodata\Mage2typo3\Domain\Model\Products();

        $productsRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ProductsRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $productsRepository->expects(self::once())->method('update')->with($products);
        $this->inject($this->subject, 'productsRepository', $productsRepository);

        $this->subject->updateAction($products);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenProductsFromProductsRepository()
    {
        $products = new \Graphodata\Mage2typo3\Domain\Model\Products();

        $productsRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ProductsRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $productsRepository->expects(self::once())->method('remove')->with($products);
        $this->inject($this->subject, 'productsRepository', $productsRepository);

        $this->subject->deleteAction($products);
    }
}
