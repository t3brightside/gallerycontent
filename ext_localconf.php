<?php
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

defined('TYPO3') || die('Access denied.');

(function () {
    $versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
    // Only include page.tsconfig if TYPO3 version is below 13 so that it is not imported twice.
    if ($versionInformation->getMajorVersion() < 13) {
        TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
            @import "EXT:gallerycontent/Configuration/TSConfig/wizard.tsconfig"
        ');
    }
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
