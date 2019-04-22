<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Graphodata.Mage2typo3',
            'Product',
            'Magento 2 Product'
        );

        $pluginSignature = str_replace('_', '', 'mage2typo3') . '_product';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature,
            'FILE:EXT:mage2typo3/Configuration/FlexForms/flexform_product.xml');

        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Graphodata.Mage2typo3',
                'tools', // Make module a submodule of 'tools'
                'importconfiguration', // Submodule key
                '', // Position
                [
                    'ImportConfiguration' => 'list, create, edit, delete, show, new',
                    'Shop' => 'list,create,edit,delete,new,show'

                ],
                [
                    'access' => 'user,group',
                    'icon' => 'EXT:mage2typo3/Resources/Public/Icons/user_mod_importconfiguration.svg',
                    'labels' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_importconfiguration.xlf',
                ]
            );

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Graphodata.Mage2typo3',
                'web', // Make module a submodule of 'web'
                'product', // Submodule key
                '', // Position
                [
                    'Product' => 'list, show, detail',
                    'ProductCategory' => 'list, show, detail',

                ],
                [
                    'access' => 'user,group',
                    'icon' => 'EXT:mage2typo3/Resources/Public/Icons/user_mod_product.svg',
                    'labels' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_product.xlf',
                ]
            );

        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('mage2typo3', 'Configuration/TypoScript',
            'Mage2Typo3');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mage2typo3_domain_model_product',
            'EXT:mage2typo3/Resources/Private/Language/locallang_csh_tx_mage2typo3_domain_model_product.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mage2typo3_domain_model_product');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mage2typo3_domain_model_productcategory',
            'EXT:mage2typo3/Resources/Private/Language/locallang_csh_tx_mage2typo3_domain_model_productcategory.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mage2typo3_domain_model_productcategory');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mage2typo3_domain_model_shop',
            'EXT:mage2typo3/Resources/Private/Language/locallang_csh_tx_mage2typo3_domain_model_shop.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mage2typo3_domain_model_shop');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mage2typo3_domain_model_importconfiguration',
            'EXT:mage2typo3/Resources/Private/Language/locallang_csh_tx_mage2typo3_domain_model_importconfiguration.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mage2typo3_domain_model_importconfiguration');

    }
);
