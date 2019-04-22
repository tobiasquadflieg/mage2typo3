<?php
namespace Graphodata\Mage2typo3\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Tobias Quadflieg <Quadflieg@graphodata.de>
 */
class ImportConfigurationControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Graphodata\Mage2typo3\Controller\ImportConfigurationController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Graphodata\Mage2typo3\Controller\ImportConfigurationController::class)
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
    public function listActionFetchesAllImportConfigurationsFromRepositoryAndAssignsThemToView()
    {

        $allImportConfigurations = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $importConfigurationRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $importConfigurationRepository->expects(self::once())->method('findAll')->will(self::returnValue($allImportConfigurations));
        $this->inject($this->subject, 'importConfigurationRepository', $importConfigurationRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('importConfigurations', $allImportConfigurations);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenImportConfigurationToImportConfigurationRepository()
    {
        $importConfiguration = new \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration();

        $importConfigurationRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $importConfigurationRepository->expects(self::once())->method('add')->with($importConfiguration);
        $this->inject($this->subject, 'importConfigurationRepository', $importConfigurationRepository);

        $this->subject->createAction($importConfiguration);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenImportConfigurationToView()
    {
        $importConfiguration = new \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('importConfiguration', $importConfiguration);

        $this->subject->editAction($importConfiguration);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenImportConfigurationInImportConfigurationRepository()
    {
        $importConfiguration = new \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration();

        $importConfigurationRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $importConfigurationRepository->expects(self::once())->method('update')->with($importConfiguration);
        $this->inject($this->subject, 'importConfigurationRepository', $importConfigurationRepository);

        $this->subject->updateAction($importConfiguration);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenImportConfigurationFromImportConfigurationRepository()
    {
        $importConfiguration = new \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration();

        $importConfigurationRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $importConfigurationRepository->expects(self::once())->method('remove')->with($importConfiguration);
        $this->inject($this->subject, 'importConfigurationRepository', $importConfigurationRepository);

        $this->subject->deleteAction($importConfiguration);
    }
}
