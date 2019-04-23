<?php
namespace Graphodata\Mage2typo3\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Tobias Quadflieg <Quadflieg@graphodata.de>
 */
class ShopTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Graphodata\Mage2typo3\Domain\Model\Shop
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Graphodata\Mage2typo3\Domain\Model\Shop();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getShopNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getShopName()
        );
    }

    /**
     * @test
     */
    public function setShopNameForStringSetsShopName()
    {
        $this->subject->setShopName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'shopName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getUrlReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getUrl()
        );
    }

    /**
     * @test
     */
    public function setUrlForStringSetsUrl()
    {
        $this->subject->setUrl('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'url',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getUserNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getUserName()
        );
    }

    /**
     * @test
     */
    public function setUserNameForStringSetsUserName()
    {
        $this->subject->setUserName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'userName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPasswordReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPassword()
        );
    }

    /**
     * @test
     */
    public function setPasswordForStringSetsPassword()
    {
        $this->subject->setPassword('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'password',
            $this->subject
        );
    }
}
