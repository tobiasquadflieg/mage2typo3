<?php

namespace Graphodata\Mage2typo3\Domain\Model;


/***
 * This file is part of the "Mage2Typo3" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *  (c) 2019 Tobias Quadflieg <Quadflieg@graphodata.de>, Graphodata AG
 ***/

/**
 * Product
 */
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * sku
     *
     * @var string
     */
    protected $sku = '';

    /**
     * createdAt
     *
     * @var \DateTime
     */
    protected $createdAt = null;

    /**
     * updatedAt
     *
     * @var \DateTime
     */
    protected $updatedAt = null;

    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * status
     *
     * @var string
     */
    protected $status = '';

    /**
     * tags
     *
     * @var string
     */
    protected $tags = '';

    /**
     * price
     *
     * @var float
     */
    protected $price = 0.0;

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * shortDescription
     *
     * @var string
     */
    protected $shortDescription = '';

    /**
     * productImage
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @cascade remove
     */
    protected $productImage = null;

    /**
     * Productcategory
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Graphodata\Mage2typo3\Domain\Model\ProductCategory>
     * @cascade remove
     */
    protected $categories = null;

    /**
     * __construct
     */
    public function __construct()
    {

        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->categories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the sku
     *
     * @return string $sku
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Sets the sku
     *
     * @param string $sku
     *
     * @return void
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * Returns the createdAt
     *
     * @return \DateTime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets the createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return void
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Returns the updatedAt
     *
     * @return \DateTime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Sets the updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the status
     *
     * @return string $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status
     *
     * @param string $status
     *
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Returns the tags
     *
     * @return string $tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Sets the tags
     *
     * @param string $tags
     *
     * @return void
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Returns the price
     *
     * @return float $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Sets the price
     *
     * @param float $price
     *
     * @return void
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     *
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the shortDescription
     *
     * @return string $shortDescription
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Sets the shortDescription
     *
     * @param string $shortDescription
     *
     * @return void
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getProductImage(): \TYPO3\CMS\Extbase\Persistence\ObjectStorage
    {
        return $this->productImage;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $productImage
     */
    public function setProductImage(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $productImage): void
    {
        $this->productImage = $productImage;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function addProductImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image): void
    {
        $this->productImage->attach($image);
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function removeProductImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image): void
    {
        $this->productImage->detach($image);
    }

    /**
     * Adds a ProductCategory
     *
     * @param \Graphodata\Mage2typo3\Domain\Model\ProductCategory $category
     *
     * @return void
     */
    public function addCategory(\Graphodata\Mage2typo3\Domain\Model\ProductCategory $category)
    {
        $this->categories->attach($category);
    }

    /**
     * Removes a ProductCategory
     *
     * @param \Graphodata\Mage2typo3\Domain\Model\ProductCategory $categoryToRemove The ProductCategory to be removed
     *
     * @return void
     */
    public function removeCategory(\Graphodata\Mage2typo3\Domain\Model\ProductCategory $categoryToRemove)
    {
        $this->categories->detach($categoryToRemove);
    }

    /**
     * Returns the categories
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Graphodata\Mage2typo3\Domain\Model\ProductCategory> $categories
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Sets the categories
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Graphodata\Mage2typo3\Domain\Model\ProductCategory> $categories
     *
     * @return void
     */
    public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories)
    {
        $this->categories = $categories;
    }
}
