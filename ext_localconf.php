<?php
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die('Access denied.');

(function () {
    ExtensionUtility::configurePlugin(
        'gallerycontent',
        'Gallerycontent',
        [
            'Gallerycontent' => 'gallerycontent'
        ],
        [], 
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT 
    );
})();
