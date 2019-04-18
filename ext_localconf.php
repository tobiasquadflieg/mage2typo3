<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Graphodata.Mage2typo3',
            'Mage2products',
            [
                'products' => 'list, show, detail',
                'categories' => 'list, show, detail'
            ],
            // non-cacheable actions
            [
                'Products' => 'create, update, delete',
                'ProductCategories' => 'create, update, delete'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    mage2products {
                        iconIdentifier = mage2typo3-plugin-mage2products
                        title = LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_mage2products.name
                        description = LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_mage2products.description
                        tt_content_defValues {
                            CType = list
                            list_type = mage2typo3_mage2products
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'mage2typo3-plugin-mage2products',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:mage2typo3/Resources/Public/Icons/user_plugin_mage2products.svg']
			);
		
    }
);
