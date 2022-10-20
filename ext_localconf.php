<?php
defined('TYPO3_MODE') || defined('TYPO3') || die('Access denied.');

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Imaging\IconRegistry;

$versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
// Only include page.tsconfig if TYPO3 version is below 12 so that it is not imported twice.
if ($versionInformation->getMajorVersion() < 12) {
   ExtensionManagementUtility::addPageTSConfig('
      @import "EXT:gallerycontent/Configuration/page.tsconfig"
   ');
}

$iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
$iconRegistry->registerIcon(
	'mimetypes-x-content-gallerycontent',
	\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
	['source' => 'EXT:gallerycontent/Resources/Public/Icons/mimetypes-x-content-gallerycontent.svg']
);


ExtensionUtility::configurePlugin(
	'gallerycontent',
	'Gallerycontent',
	[
		'Gallerycontent' => 'gallerycontent'
	]
);
