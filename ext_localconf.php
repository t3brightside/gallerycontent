<?php
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

defined('TYPO3') || die('Access denied.');

(function () {
    $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
    $iconRegistry->registerIcon(
        'mimetypes-x-content-gallerycontent',
        SvgIconProvider::class,
        ['source' => 'EXT:gallerycontent/Resources/Public/Icons/mimetypes-x-content-gallerycontent.svg']
    );

    ExtensionUtility::configurePlugin(
        'gallerycontent',
        'Gallerycontent',
        [
            'Gallerycontent' => 'gallerycontent'
        ]
    );
})();
