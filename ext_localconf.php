<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Graphodata.Mage2typo3',
            'Product',
            [
                'Product' => 'list, show, detail',
                'ProductCategory' => 'list, show, detail'
            ],
            // non-cacheable actions
            [
                'Product' => 'create, update, delete',
                'ProductCategory' => 'create, update, delete',
                'Shop' => 'create, update, delete',
                'ImportConfiguration' => 'create, update, delete'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    product {
                        iconIdentifier = mage2typo3-plugin-product
                        title = LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_product.name
                        description = LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_product.description
                        tt_content_defValues {
                            CType = list
                            list_type = mage2typo3_product
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'mage2typo3-plugin-product',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:mage2typo3/Resources/Public/Icons/user_plugin_product.svg']
			);
		
    }
);
