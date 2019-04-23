<?php
namespace Graphodata\Mage2typo3\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Tobias Quadflieg <Quadflieg@graphodata.de>
 */
class ImportConfigurationTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShopReturnsInitialValueForShop()
    {
        self::assertEquals(
            null,
            $this->subject->getShop()
        );
    }

    /**
     * @test
     */
    public function setShopForShopSetsShop()
    {
        $shopFixture = new \Graphodata\Mage2typo3\Domain\Model\Shop();
        $this->subject->setShop($shopFixture);

        self::assertAttributeEquals(
            $shopFixture,
            'shop',
            $this->subject
        );
    }
}
