<?php
namespace Graphodata\Mage2typo3\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Tobias Quadflieg <Quadflieg@graphodata.de>
 */
class ProductTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Graphodata\Mage2typo3\Domain\Model\Product
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Graphodata\Mage2typo3\Domain\Model\Product();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getSkuReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSku()
        );
    }

    /**
     * @test
     */
    public function setSkuForStringSetsSku()
    {
        $this->subject->setSku('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'sku',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCreatedAtReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getCreatedAt()
        );
    }

    /**
     * @test
     */
    public function setCreatedAtForDateTimeSetsCreatedAt()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setCreatedAt($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'createdAt',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getUpdatedAtReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getUpdatedAt()
        );
    }

    /**
     * @test
     */
    public function setUpdatedAtForDateTimeSetsUpdatedAt()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setUpdatedAt($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'updatedAt',
            $this->subject
        );
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
    public function getStatusReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getStatus()
        );
    }

    /**
     * @test
     */
    public function setStatusForStringSetsStatus()
    {
        $this->subject->setStatus('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'status',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTagsReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTags()
        );
    }

    /**
     * @test
     */
    public function setTagsForStringSetsTags()
    {
        $this->subject->setTags('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'tags',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPriceReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getPrice()
        );
    }

    /**
     * @test
     */
    public function setPriceForFloatSetsPrice()
    {
        $this->subject->setPrice(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'price',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getDescriptionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription()
    {
        $this->subject->setDescription('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'description',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShortDescriptionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getShortDescription()
        );
    }

    /**
     * @test
     */
    public function setShortDescriptionForStringSetsShortDescription()
    {
        $this->subject->setShortDescription('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'shortDescription',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getProductImageReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getProductImage()
        );
    }

    /**
     * @test
     */
    public function setProductImageForFileReferenceSetsProductImage()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setProductImage($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'productImage',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCategoriesReturnsInitialValueForProductCategory()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getCategories()
        );
    }

    /**
     * @test
     */
    public function setCategoriesForObjectStorageContainingProductCategorySetsCategories()
    {
        $category = new \Graphodata\Mage2typo3\Domain\Model\ProductCategory();
        $objectStorageHoldingExactlyOneCategories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneCategories->attach($category);
        $this->subject->setCategories($objectStorageHoldingExactlyOneCategories);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneCategories,
            'categories',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addCategoryToObjectStorageHoldingCategories()
    {
        $category = new \Graphodata\Mage2typo3\Domain\Model\ProductCategory();
        $categoriesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $categoriesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($category));
        $this->inject($this->subject, 'categories', $categoriesObjectStorageMock);

        $this->subject->addCategory($category);
    }

    /**
     * @test
     */
    public function removeCategoryFromObjectStorageHoldingCategories()
    {
        $category = new \Graphodata\Mage2typo3\Domain\Model\ProductCategory();
        $categoriesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $categoriesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($category));
        $this->inject($this->subject, 'categories', $categoriesObjectStorageMock);

        $this->subject->removeCategory($category);
    }
}
