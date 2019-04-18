<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Graphodata.Mage2typo3',
            'Mage2products',
            'Magento 2 Product'
        );

        $pluginSignature = str_replace('_', '', 'mage2typo3') . '_mage2products';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:mage2typo3/Configuration/FlexForms/flexform_mage2products.xml');

        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Graphodata.Mage2typo3',
                'tools', // Make module a submodule of 'tools'
                'mage2import', // Submodule key
                '', // Position
                [
                    'Be\Import' => 'settings, run, configure',
                    
                ],
                [
                    'access' => 'user,group',
                    'icon'   => 'EXT:mage2typo3/Resources/Public/Icons/user_mod_mage2import.svg',
                    'labels' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_mage2import.xlf',
                ]
            );

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Graphodata.Mage2typo3',
                'web', // Make module a submodule of 'web'
                'mage2products', // Submodule key
                '', // Position
                [
                    'Be\Products' => 'list, show',
                    'Be\Categories' => 'list, show',
                    
                ],
                [
                    'access' => 'user,group',
                    'icon'   => 'EXT:mage2typo3/Resources/Public/Icons/user_mod_mage2products.svg',
                    'labels' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_mage2products.xlf',
                ]
            );

        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('mage2typo3', 'Configuration/TypoScript', 'Mage2Typo3');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mage2typo3_domain_model_products', 'EXT:mage2typo3/Resources/Private/Language/locallang_csh_tx_mage2typo3_domain_model_products.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mage2typo3_domain_model_products');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mage2typo3_domain_model_productcategories', 'EXT:mage2typo3/Resources/Private/Language/locallang_csh_tx_mage2typo3_domain_model_productcategories.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mage2typo3_domain_model_productcategories');

    }
);
