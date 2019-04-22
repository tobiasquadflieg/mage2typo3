<?php
namespace Graphodata\Mage2typo3\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Tobias Quadflieg <Quadflieg@graphodata.de>
 */
class ImportSettingsControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Graphodata\Mage2typo3\Controller\ImportSettingsController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Graphodata\Mage2typo3\Controller\ImportSettingsController::class)
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
    public function listActionFetchesAllImportSettingssFromRepositoryAndAssignsThemToView()
    {

        $allImportSettingss = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $importSettingsRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ImportSettingsRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $importSettingsRepository->expects(self::once())->method('findAll')->will(self::returnValue($allImportSettingss));
        $this->inject($this->subject, 'importSettingsRepository', $importSettingsRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('importSettingss', $allImportSettingss);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenImportSettingsToImportSettingsRepository()
    {
        $importSettings = new \Graphodata\Mage2typo3\Domain\Model\ImportSettings();

        $importSettingsRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ImportSettingsRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $importSettingsRepository->expects(self::once())->method('add')->with($importSettings);
        $this->inject($this->subject, 'importSettingsRepository', $importSettingsRepository);

        $this->subject->createAction($importSettings);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenImportSettingsToView()
    {
        $importSettings = new \Graphodata\Mage2typo3\Domain\Model\ImportSettings();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('importSettings', $importSettings);

        $this->subject->editAction($importSettings);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenImportSettingsInImportSettingsRepository()
    {
        $importSettings = new \Graphodata\Mage2typo3\Domain\Model\ImportSettings();

        $importSettingsRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ImportSettingsRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $importSettingsRepository->expects(self::once())->method('update')->with($importSettings);
        $this->inject($this->subject, 'importSettingsRepository', $importSettingsRepository);

        $this->subject->updateAction($importSettings);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenImportSettingsFromImportSettingsRepository()
    {
        $importSettings = new \Graphodata\Mage2typo3\Domain\Model\ImportSettings();

        $importSettingsRepository = $this->getMockBuilder(\Graphodata\Mage2typo3\Domain\Repository\ImportSettingsRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $importSettingsRepository->expects(self::once())->method('remove')->with($importSettings);
        $this->inject($this->subject, 'importSettingsRepository', $importSettingsRepository);

        $this->subject->deleteAction($importSettings);
    }
}
