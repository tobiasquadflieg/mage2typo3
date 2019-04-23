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
 * Shop
 */
class Shop extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * shopName
     * 
     * @var string
     */
    protected $shopName = '';

    /**
     * url
     * 
     * @var string
     */
    protected $url = '';

    /**
     * userName
     * 
     * @var string
     */
    protected $userName = '';

    /**
     * password
     * 
     * @var string
     */
    protected $password = '';

    /**
     * Returns the shopName
     * 
     * @return string $shopName
     */
    public function getShopName()
    {
        return $this->shopName;
    }

    /**
     * Sets the shopName
     * 
     * @param string $shopName
     * @return void
     */
    public function setShopName($shopName)
    {
        $this->shopName = $shopName;
    }

    /**
     * Returns the url
     * 
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url
     * 
     * @param string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Returns the userName
     * 
     * @return string $userName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Sets the userName
     * 
     * @param string $userName
     * @return void
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * Returns the password
     * 
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the password
     * 
     * @param string $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
