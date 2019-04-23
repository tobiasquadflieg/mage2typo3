<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_domain_model_products',
        'label' => 'sku',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'sku,name,status,tags,description,short_description',
        'iconfile' => 'EXT:mage2typo3/Resources/Public/Icons/tx_mage2typo3_domain_model_products.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, sku, created_at, updated_at, name, status, tags, price, description, short_description, categories, images',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, sku, created_at, updated_at, name, status, tags, price, description, short_description, categories, images, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_mage2typo3_domain_model_products',
                'foreign_table_where' => 'AND {#tx_mage2typo3_domain_model_products}.{#pid}=###CURRENT_PID### AND {#tx_mage2typo3_domain_model_products}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'sku' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_domain_model_products.sku',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'created_at' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_domain_model_products.created_at',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 10,
                'eval' => 'datetime',
                'default' => time()
            ],
        ],
        'updated_at' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_domain_model_products.updated_at',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 10,
                'eval' => 'datetime',
                'default' => time()
            ],
        ],
        'name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_domain_model_products.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_domain_model_products.status',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'tags' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_domain_model_products.tags',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'price' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_domain_model_products.price',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_domain_model_products.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'short_description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_domain_model_products.short_description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'categories' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_domain_model_products.categories',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_mage2typo3_domain_model_productcategories',
                'foreign_field' => 'products',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],

        ],
        'images' => [
            'exclude' => true,
            'label' => 'LLL:EXT:mage2typo3/Resources/Private/Language/locallang_db.xlf:tx_mage2typo3_domain_model_products.images',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file_reference',
                'foreign_field' => 'products',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],

        ],
    
    ],
];
