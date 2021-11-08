<?php
  defined('TYPO3_MODE') || die('Access denied.');

  call_user_func(function () {
      $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['gallerycontent'] =  'mimetypes-x-content-gallerycontent';

      \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
      "tt_content",
      "CType",
      [
        "Gallery",
        "gallerycontent",
        "mimetypes-x-content-gallerycontent"
      ],
      'textmedia',
      'after'
      );


    $GLOBALS['TCA']['tt_content']['columns']['tx_gallerycontent_template'] = [
        'exclude' => 1,
        'label'   => 'Template',
        'config'  => array(
            'type'     => 'select',
            'renderType' => 'selectSingle',
            'default' => 0,
            'items'    => array(), /* items set in page TsConfig */
        ),
    ];

    $GLOBALS['TCA']['tt_content']['columns']['tx_gallerycontent_cropratio'] = [
        'exclude' => 1,
        'label'   => 'Crop',
        'config'  => array(
            'type'     => 'select',
            'renderType' => 'selectSingle',
            'default' => 'default',
            'items'    => array(), /* items set in page TsConfig */
        ),
    ];
    $GLOBALS['TCA']['tt_content']['columns']['tx_gallerycontent_cropratiozoom'] = [
        'exclude' => 1,
        'label'   => 'Crop',
        'config'  => array(
            'type'     => 'select',
            'renderType' => 'selectSingle',
            'default' => 'default',
            'items'    => array(), /* items set in page TsConfig */
        ),
    ];
    $GLOBALS['TCA']['tt_content']['columns']['tx_gallerycontent_showtitle'] = [
        'exclude' => 1,
        'label' => 'Show titles',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '',
                    1 => '',
                ]
            ],
        ]
    ];
    $GLOBALS['TCA']['tt_content']['columns']['tx_gallerycontent_showdesc'] = [
        'exclude' => 1,
        'label' => 'Show descriptions',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '',
                    1 => '',
                ]
            ],
        ]
    ];
    $GLOBALS['TCA']['tt_content']['columns']['tx_gallerycontent_paginate'] = [
        'exclude' => 1,
        'label' => 'Pagination',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '',
                    1 => '',
                ]
            ],
        ]
    ];
    $GLOBALS['TCA']['tt_content']['columns']['tx_gallerycontent_paginateitems'] = [
        'exclude' => 1,
        'label' => 'Items per page',
        'config' => array(
            'type' => 'input',
            'eval' => 'num,trim',
            'size' => '1',
        ),
    ];
    $GLOBALS['TCA']['tt_content']['columns']['tx_gallerycontent_showtitlezoom'] = [
        'exclude' => 1,
        'label' => 'Show title',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '',
                    1 => '',
                ]
            ],
        ]
    ];
    $GLOBALS['TCA']['tt_content']['columns']['tx_gallerycontent_showdesczoom'] = [
        'exclude' => 1,
        'label' => 'Show description',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '',
                    1 => '',
                ]
            ],
        ]
    ];

    // Configure the default backend fields for the gallery content element
    $GLOBALS['TCA']['tt_content']['types']['gallerycontent'] = array(
       'showitem' => '
             --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.general;general,
             --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.header;header,
             --palette--;Images;gallerycontentSettings,
             --palette--;Click enlarge;gallerycontentZoomSettings,assets,
             --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
               --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
               --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
             --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.accessibility,
               --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.menu_accessibility;menu_accessibility,
             --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
               --palette--;;language,
             --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
               --palette--;;hidden,
               --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
             --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
               categories,
             --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
               rowDescription,
             --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
             --div--;LLL:EXT:gridelements/Resources/Private/Language/locallang_db.xlf:gridElements, tx_gridelements_container, tx_gridelements_columns
    ',
    'columnsOverrides' => [
        'assets' => [
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'assets',
                [
                    'behaviour' => [
                        'allowLanguageSynchronization' => true,
                    ],
                    // custom configuration for displaying fields in the overlay/reference table
                    // to use the image overlay palette instead of the basic overlay palette
                    'overrideChildTca' => [
                        'columns' => [
                            'crop' => [
                            'config' => [
                                'cropVariants' => [

                                    'default' => [
                                        'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.crop_variant.default',
                                        'allowedAspectRatios' => [
                                            '16:9' => [
                                                'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
                                                'value' => 16 / 9
                                            ],
                                            '3:2' => [
                                                'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.3_2',
                                                'value' => 3 / 2
                                            ],
                                            '4:3' => [
                                                'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.4_3',
                                                'value' => 4 / 3
                                            ],
                                            '1:1' => [
                                                'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.1_1',
                                                'value' => 1.0
                                            ],
                                            'NaN' => [
                                                'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free',
                                                'value' => 0.0
                                            ],
                                        ],
                                        'selectedRatio' => 'NaN',
                                        'cropArea' => [
                                            'x' => 0.0,
                                            'y' => 0.0,
                                            'width' => 1.0,
                                            'height' => 1.0,
                                        ],
                                    ],
                                    'tv' => [
                                        'title' => 'TV (4:3)',
                                        'selectedRatio' => '4:3',
                                        'allowedAspectRatios' => [
                                            '4:3' => [
                                                'title' => 'TV',
                                                'value' => 4 / 3,
                                            ],
                                        ],
                                    ],
                                    'widescreen' => [
                                        'title' => 'Widescreen (16:9)',
                                        'selectedRatio' => '16:9',
                                        'allowedAspectRatios' => [
                                            '16:9' => [
                                                'title' => 'Widescreen',
                                                'value' => 16 / 9,
                                            ],
                                        ],
                                    ],
                                    'anamorphic' => [
                                        'title' => 'Anamorphic (2.39:1)',
                                        'selectedRatio' => '2.39:1',
                                        'allowedAspectRatios' => [
                                            '2.39:1' => [
                                                'title' => 'Anamorphic',
                                                'value' => 2.39 / 1,
                                            ],
                                        ],
                                    ],
                                    'square' => [
                                        'title' => 'Square (1:1)',
                                        'selectedRatio' => '1:1',
                                        'allowedAspectRatios' => [
                                            '1:1' => [
                                                'title' => 'Square',
                                                'value' => 1 / 1,
                                            ],
                                        ],
                                    ],
                                    'portrait' => [
                                        'title' => 'Portrait (3:4)',
                                        'selectedRatio' => '3:4',
                                        'allowedAspectRatios' => [
                                            '3:4' => [
                                                'title' => 'Portrait (three-four)',
                                                'value' => 3 / 4,
                                            ],
                                        ],
                                    ],
                                    'tower' => [
                                        'title' => 'Tower (9:16)',
                                        'selectedRatio' => '9:16',
                                        'allowedAspectRatios' => [
                                            '9:16' => [
                                                'title' => 'Tower',
                                                'value' => 9 / 16,
                                            ],
                                        ],
                                    ],
                                    'skyscraper' => [
                                        'title' => 'Skyscraper (1:2.39)',
                                        'selectedRatio' => '1:2.39',
                                        'allowedAspectRatios' => [
                                            '1:2.39' => [
                                                'title' => 'Skyscraper',
                                                'value' => 1 / 2.39,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    ],
                ],
                'jpg,jpeg,png,svg,pdf,ai,tiff,bmp,gif'
            ),
            ],
        ]);

    $GLOBALS['TCA']['tt_content']['palettes']['gallerycontentSettings']['showitem'] = '
        tx_gallerycontent_template,imagecols,tx_gallerycontent_cropratio,
        tx_gallerycontent_showtitle,tx_gallerycontent_showdesc,
        tx_gallerycontent_paginate,tx_gallerycontent_paginateitems,
    ';
    $GLOBALS['TCA']['tt_content']['palettes']['gallerycontentZoomSettings']['showitem'] = '
        image_zoom,tx_gallerycontent_cropratiozoom,tx_gallerycontent_showtitlezoom,tx_gallerycontent_showdesczoom,
    ';

});
