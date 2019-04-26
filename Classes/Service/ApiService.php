<?php


namespace Graphodata\Mage2typo3\Service;


use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ApiService
 *
 * @package Graphodata\Mage2typo3\Service
 */
class ApiService implements SingletonInterface
{
    /**
     * The Token that comes Back due the authprozess
     *
     * @var string $authToken
     */
    protected $authToken;

    /**
     * @var \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration
     */
    protected $importConfiguration;

    /**
     * @var \Graphodata\Mage2typo3\Domain\Model\Shop
     */
    protected $shopConfiguration;

    /**
     * @var \TYPO3\CMS\Core\Http\RequestFactory $requestFactory
     */
    protected $requestFactory;

    /**
     * ApiService constructor.
     *
     * @param $importConfiguration
     */
    public function __construct($importConfiguration)
    {
        $this->importConfiguration = $importConfiguration;
        $this->shopConfiguration = $this->importConfiguration->getShop();
        $this->requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
    }

    /**
     * Returns the auth key from the authentication Process
     *
     * @return string $authkey
     */
    public function getAuthToken()
    {
        if ($this->importConfiguration == null) {
            throw new \UnexpectedValueException('No Import configuration is set');
        };
        $jsonUserData = json_encode([
            'username' => $this->shopConfiguration->getUserName(),
            'password' => $this->shopConfiguration->getPassword()
        ]);
        $additionalOptions = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Content-Lenght' => strlen($jsonUserData)

            ],
            'body' => $jsonUserData,
            //TODO Adding htaccess password support
        ];
        $response = $this->requestFactory->request($this->shopConfiguration->getUrl() . 'index.php/rest/V1/integration/admin/token?username=' . $this->shopConfiguration->getUserName() . '&password=' . $this->shopConfiguration->getPassword(),
            'POST');
        if ($response->getStatusCode() === 200) {
            if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
                $this->authToken = json_decode($response->getBody()->getContents());
                return true;
            } else {
                throw new \UnexpectedValueException('No authkey was delivered, please check Credentials');
                return false;
            }
        }
    }

    public function getProductsCount(): int
    {
        if ($this->authToken == null) {
            throw new \UnexpectedValueException('get first an Authkey!');
        }
        $additionalOptions = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->authToken,

            ],
        ];
        $url = $this->shopConfiguration->getUrl() . 'index.php/rest/V1/products?searchCriteria[pageSize]=1&searchCriteria[currentPage]=9999999';
        $response = $this->requestFactory->request($url, 'GET', $additionalOptions);
        if ($response->getStatusCode() === 200) {
            if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
                $totalcount = json_decode($response->getBody()->getContents(), true);
                return $totalcount['total_count'];

            }
        } else {
            throw new \HttpResponseException('Couldnt get any Products');
        }
    }

    /**
     * @return array
     * @throws \HttpResponseException
     */
    public function getProducts(int $maxItems = 100, int $page)
    {
        if ($this->authToken == null) {
            throw new \UnexpectedValueException('get first an Authkey!');
        }
        $additionalOptions = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->authToken,

            ],
        ];
        $url = $this->shopConfiguration->getUrl() . 'index.php/rest/V1/products?fields=items[sku,name,created_at,updated_at,media_gallery_entries,price]&searchCriteria[pageSize]=' . $maxItems . '&searchCriteria[currentPage]=' . $page;
        $response = $this->requestFactory->request($url, 'GET', $additionalOptions);
        if ($response->getStatusCode() === 200) {
            if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
                $items = json_decode($response->getBody()->getContents(), true);
                return $items['items'];
            }
        } else {
            throw new \HttpResponseException('Couldnt get any Products');
        }

    }

    public function getProductdetails(string $productSku)
    {
        if ($this->authToken == null) {
            throw new \UnexpectedValueException('get first an Authkey!');
        }
        $additionalOptions = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->authToken,

            ],
        ];
        $url = $this->shopConfiguration->getUrl() . 'index.php/rest/V1/products/' . $productSku;
        $response = $this->requestFactory->request($url, 'GET', $additionalOptions);
        if ($response->getStatusCode() === 200) {
            if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
                $items = json_decode($response->getBody()->getContents(), true);
                return $items;
            }
        } else {
            throw new \HttpResponseException('Couldnt get any Products');
        }
    }
}