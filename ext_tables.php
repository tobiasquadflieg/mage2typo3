<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('mage2typo3', 'Configuration/TypoScript', 'Mage2Typo3');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mage2typo3_domain_model_products', 'EXT:mage2typo3/Resources/Private/Language/locallang_csh_tx_mage2typo3_domain_model_products.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mage2typo3_domain_model_products');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mage2typo3_domain_model_productcategories', 'EXT:mage2typo3/Resources/Private/Language/locallang_csh_tx_mage2typo3_domain_model_productcategories.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mage2typo3_domain_model_productcategories');

    }
);
