<?php

defined('TYPO3_MODE') || die('Access denied.');

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['gallerycontent'] =  'mimetypes-x-content-gallerycontent';

// Get extension configuration
$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
    \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
);
$extensionConfiguration = $extensionConfiguration->get('gallerycontent');

// Add to content type dropdown
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

$tempColumns = array(
    'tx_gallerycontent_template' => [
        'exclude' => 1,
        'label'   => 'Template',
        'config'  => [
            'type'     => 'select',
            'renderType' => 'selectSingle',
            'default' => 0,
            'items'    => array(), /* items set in page TsConfig */
        ],
    ],
    'tx_gallerycontent_cropratio' => [
        'exclude' => 1,
        'label'   => 'Crop',
        'config'  => [
            'type'     => 'select',
            'renderType' => 'selectSingle',
            'default' => 'default',
            'items'    => array(), /* items set in page TsConfig */
        ],
    ],
    'tx_gallerycontent_cropratiozoom' => [
        'exclude' => 1,
        'label'   => 'Crop',
        'config'  => [
            'type'     => 'select',
            'renderType' => 'selectSingle',
            'default' => 'default',
            'items'    => array(), /* items set in page TsConfig */
        ],
    ],
    'tx_gallerycontent_showtitle' => [
        'exclude' => 1,
        'label' => 'Title',
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
    ],
    'tx_gallerycontent_showdesc' => [
        'exclude' => 1,
        'label' => 'Description',
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
    ],
    'tx_gallerycontent_showtitlezoom' => [
        'exclude' => 1,
        'label' => 'Title',
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
    ],
    'tx_gallerycontent_showdesczoom' => [
        'exclude' => 1,
        'label' => 'Description',
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
    ],
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);


$GLOBALS['TCA']['tt_content']['types']['gallerycontent']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,
        --palette--;Images;gallerycontentImages,
    --div--;Gallery;,--palette--;Layout;gallerycontentLayout,
        --palette--;Click Enlarge;gallerycontentZoom,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';

if ($extensionConfiguration['gallerycontentEnablePagination']) {
    $GLOBALS['TCA']['tt_content']['types']['gallerycontent']['showitem'] = str_replace(
        ';gallerycontentZoom,',
        ';gallerycontentZoom,
		--palette--;LLL:EXT:paginatedprocessors/Resources/Private/Language/locallang_tca.xlf:palettes.pagination;paginatedprocessors,',
        $GLOBALS['TCA']['tt_content']['types']['gallerycontent']['showitem']
    );
}

$GLOBALS['TCA']['tt_content']['types']['gallerycontent']['columnsOverrides'] = array(
    'assets' => [
        'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
            'assets',
            [
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
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
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
        ),
    ],
);
$GLOBALS['TCA']['tt_content']['palettes']['gallerycontentImages']['showitem'] = '
    assets,
';

$GLOBALS['TCA']['tt_content']['palettes']['gallerycontentLayout']['showitem'] = '
    tx_gallerycontent_template,
    --linebreak--,
    imagecols,
    tx_gallerycontent_cropratio,
    tx_gallerycontent_showtitle,
    tx_gallerycontent_showdesc,
';
$GLOBALS['TCA']['tt_content']['palettes']['gallerycontentZoom']['showitem'] = '
    image_zoom,
    tx_gallerycontent_cropratiozoom,
    tx_gallerycontent_showtitlezoom,
    tx_gallerycontent_showdesczoom,
';


// $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem'] = $GLOBALS['TCA']['pages']['types'][1]['showitem'];

// Replace textmedia media section with callerycontent
if ($extensionConfiguration['gallerycontentReplaceTextmediaMedia']) {

    $GLOBALS['TCA']['tt_content']['types']['textmedia']['columnsOverrides']['assets'] = $GLOBALS['TCA']['tt_content']['types']['gallerycontent']['columnsOverrides']['assets'];

    $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem'] = str_replace(
        'assets,',
        '',
        $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem']
    );
    $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem'] = str_replace(
        '--palette--;;gallerySettings,',
        '',
        $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem']
    );
    $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem'] = str_replace(
        '--palette--;;imagelinks,',
        '',
        $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem']
    );
    $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem'] = str_replace(
        '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,',
        '',
        $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem']
    );
    $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem'] = str_replace(
        '--palette--;;mediaAdjustments,',
        '--palette--;Images;gallerycontentImages,
            --div--;Gallery;,
            --palette--;Placement and Size;galleryPlaceAndSize,
            --palette--;Layout;gallerycontentLayout,
            --palette--;Click Enlarge;gallerycontentZoom,
        ',
        $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem']
    );
    if ($extensionConfiguration['gallerycontentEnablePagination']) {
        $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem'] = str_replace(
            ';gallerycontentZoom,',
            ';gallerycontentZoom,
    		--palette--;LLL:EXT:paginatedprocessors/Resources/Private/Language/locallang_tca.xlf:palettes.pagination;paginatedprocessors,',
            $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem']
        );
    }

    $GLOBALS['TCA']['tt_content']['palettes']['galleryPlaceAndSize']['showitem'] = '
        imageorient;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient_formlabel,
        imagewidth;Gallery Width In Percentage,
    ';
}
