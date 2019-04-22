<?php
namespace Graphodata\Mage2typo3\Domain\Model;


/***
 * This file is part of the "Mage2Typo3" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *  (c) 2019 Tobias Quadflieg <Quadflieg@graphodata.de>, Graphodata AG
 ***/
/**
 * ImportConfiguration
 */
class ImportConfiguration extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var string $name
     */
    protected $name = null;

    /**
     * shop
     * 
     * @var \Graphodata\Mage2typo3\Domain\Model\Shop
     */
    protected $shop = null;

    /**
     * Returns the name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     * 
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns the shop
     * 
     * @return \Graphodata\Mage2typo3\Domain\Model\Shop $shop
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * Sets the shop
     * 
     * @param \Graphodata\Mage2typo3\Domain\Model\Shop $shop
     * @return void
     */
    public function setShop(\Graphodata\Mage2typo3\Domain\Model\Shop $shop)
    {
        $this->shop = $shop;
    }
}
