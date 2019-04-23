<?php

namespace Graphodata\Mage2typo3\Controller;


use Graphodata\Mage2typo3\Command\ImportCommandController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/***
 * This file is part of the "Mage2Typo3" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *  (c) 2019 Tobias Quadflieg <Quadflieg@graphodata.de>, Graphodata AG
 ***/

/**
 * ImportConfigurationController
 */
class ImportConfigurationController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * importConfigurationRepository
     *
     * @var \Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository
     */
    protected $importConfigurationRepository = null;

    /**
     * shopRepository
     *
     * @var \Graphodata\Mage2typo3\Domain\Repository\ShopRepository
     */
    protected $shopRepository = null;

    /**
     * Import Command Controller
     *
     * @var \Graphodata\Mage2typo3\Command\ImportCommandController
     */
    protected $importCommandController = null;

    /**
     * @param \Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository $importConfigurationRepository
     */
    public function injectImportConfigurationRepository(
        \Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository $importConfigurationRepository
    ) {
        $this->importConfigurationRepository = $importConfigurationRepository;
    }

    /**
     * @param \Graphodata\Mage2typo3\Domain\Repository\ShopRepository $shopRepository
     */
    public function injectShopRepository(\Graphodata\Mage2typo3\Domain\Repository\ShopRepository $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    /**
     * @param \Graphodata\Mage2typo3\Command\ImportCommandController
     */
    public function injectImportCommandController(ImportCommandController $importCommandController)
    {
        $this->importCommandController = $importCommandController;
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $importConfigurations = $this->importConfigurationRepository->findAll();
        $this->view->assign('importConfigurations', $importConfigurations);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        $shops = $this->shopRepository->findAll();
        $this->view->assign('shops', $shops);
    }

    /**
     * action create
     *
     * @param \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $newImportConfiguration
     *
     * @return void
     */
    public function createAction(\Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $newImportConfiguration)
    {
        $this->addFlashMessage(
            'The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );
        $this->importConfigurationRepository->add($newImportConfiguration);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration
     * @ignorevalidation $importConfiguration
     *
     * @return void
     */
    public function editAction(\Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration)
    {
        $shops = $this->shopRepository->findAll();
        $this->view->assign('shops', $shops);
        $this->view->assign('importConfiguration', $importConfiguration);
    }

    /**
     * action update
     *
     * @param \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration
     *
     * @return void
     */
    public function updateAction(\Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration)
    {
        $shops = $this->shopRepository->findAll();
        $this->view->assign('shops', $shops);
        $this->addFlashMessage(
            'The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );
        $this->importConfigurationRepository->update($importConfiguration);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration
     *
     * @return void
     */
    public function deleteAction(\Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration)
    {
        $this->addFlashMessage(
            'The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );
        $this->importConfigurationRepository->remove($importConfiguration);
        $this->redirect('list');
    }

    /**
     * run delete
     *
     * @param \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration
     *
     * @return void
     */
    public function runAction(\Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration)
    {
        $this->addFlashMessage(
            'Run the Import for the selected Configuration, Imports all Products and Categories form the Shop',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO
        );
        $requestFactory = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Http\RequestFactory::class);
        $shopConf = $importConfiguration->getShop();
        $jsonUserData = json_encode([
            'username' => $shopConf->getUserName(),
            'password' => $shopConf->getPassword()
        ]);
        DebuggerUtility::var_dump($jsonUserData);
        $additionalOptions = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Content-Lenght' => strlen($jsonUserData)

            ],
            'body' => $jsonUserData,
            'auth' => ['graphodata', 'webstage']
        ];
        $url = 'http://abschlussarbeit.dev3.graphodata.de/index.php/rest/V1/integration/admin/token';

        $response = $requestFactory->request($url, 'POST', $additionalOptions);
        if ($response->getStatusCode() === 200) {
            if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
                $adminkey = $response->getBody()->getContents();
            }
        }
        DebuggerUtility::var_dump($adminkey);
        $additionalOptions = [
            'headers' => [
//                'Authorization' => 'Basic' . base64_encode('graphodata:webstage'),
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . json_decode($adminkey),

            ],
        ];
        DebuggerUtility::var_dump($additionalOptions);
        $url = 'http://abschlussarbeit.dev3.graphodata.de/index.php/rest/V1/products?searchCriteria';
        $requestFactory = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Http\RequestFactory::class);
        $response = $requestFactory->request($url, 'GET', $additionalOptions);
        if ($response->getStatusCode() === 200) {
            if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
                $content = $response->getBody()->getContents();
                DebuggerUtility::var_dump($content);
            }
        }
//        if ($response->getStatusCode() === 200) {
//            if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
//                $adminkey = $response->getBody()->getContents();
//            }
//        }

//        DebuggerUtility::var_dump($shopConf);
//        $userData = array("username" => $shopConf->getUserName(), "password" => $shopConf->getPassword());
//        $ch = curl_init("http://graphodata:webstage@abschlussarbeit.dev3.graphodata.de/index.php/rest/V1/integration/admin/token");
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER,
//            array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));
//
//        $token = curl_exec($ch);
//        DebuggerUtility::var_dump($token);
//
//        $ch = curl_init("http://graphodata:webstage@abschlussarbeit.dev3.graphodata.de/index.php/rest/V1/products?searchCriteria");
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER,
//            array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));
//
//        $result = curl_exec($ch);
//        DebuggerUtility::var_dump($result);
//        $this->view->assignMultiple([
//            'key' => $token,
//            'result' => $result
//        ]);
    }
}
