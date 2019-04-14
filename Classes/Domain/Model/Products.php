<?php
namespace Graphodata\Mage2typo3\Domain\Model;


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
 * Products
 */
class Products extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
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
     * categories
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<>
     * @cascade remove
     */
    protected $categories = null;

    /**
     * images
     * 
     * @var
     */
    protected $images = null;

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
     * @return void
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * Adds a
     * 
     * @param  $category
     * @return void
     */
    public function addCategory($category)
    {
        $this->categories->attach($category);
    }

    /**
     * Removes a
     * 
     * @param $categoryToRemove The  to be removed
     * @return void
     */
    public function removeCategory($categoryToRemove)
    {
        $this->categories->detach($categoryToRemove);
    }

    /**
     * Returns the categories
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<> $categories
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Sets the categories
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<> $categories
     * @return void
     */
    public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Returns the images
     * 
     * @return  $images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets the images
     * 
     * @param string $images
     * @return void
     */
    public function setImages($images)
    {
        $this->images = $images;
    }
}
