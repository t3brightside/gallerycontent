<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Brightside\Gallerycontent\Preview;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Backend\Preview\PreviewRendererInterface;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\OnlineMediaHelperRegistry;

/**
 * Contains a preview rendering for the page module of CType="textmedia"
 * @internal this is a concrete TYPO3 hook implementation and solely used for EXT:frontend and not part of TYPO3's Core API.
 */
class GallerycontentPreviewRenderer extends StandardContentPreviewRenderer
{
    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        $content = '';
        $row = $item->getRecord();
        if ($row['CType'] === 'gallerycontent') {
            if ($row['assets']) {
                $content .= $this->linkEditContent($this->getThumbCodeUnlinked($row, 'tt_content', 'assets'), $row);
                $fileReferences = BackendUtility::resolveFileReferences('tt_content', 'assets', $row);
                if (!empty($fileReferences)) {
                    $linkedContent = '';
                    $content .= $this->linkEditContent($linkedContent, $row);
                    unset($linkedContent);
                }
            }
            $content .= '<ul style="margin: 0; margin-top: 0.5em; padding: 0.2em 1.4em;">';
            if ($row['tx_gallerycontent_template'] != 0) {
                $content .= '<li>' . $this->linkEditContent($this->renderText('Template: ' . $row['tx_gallerycontent_template']), $row) . '</li>';
            }
            if ($row['tx_gallerycontent_showtitle'] === 1) {
                $content .= '<li>' . $this->linkEditContent($this->renderText('Show titles: yes'), $row) . '</li>';
            }
            if ($row['tx_gallerycontent_showdesc'] === 1) {
                $content .= '<li>' . $this->linkEditContent($this->renderText('Show descriptions: yes'), $row) . '</li>';
            }
            $content .= '<li>' . $this->linkEditContent($this->renderText('Image crop: ' . $row['tx_gallerycontent_cropratio']), $row) . '</li>';
            if ($row['image_zoom'] === 1) {
                $content .= '<li>' . $this->linkEditContent($this->renderText('Click-enlarge: yes'), $row) . '</li>';
            }
            if ($row['image_zoom'] === 1) {
                $content .= '<li>' . $this->linkEditContent($this->renderText('Click-enlarge crop: ' . $row['tx_gallerycontent_cropratiozoom']), $row) . '</li>';
            }
            if ($row['tx_paginatedprocessors_paginationenabled'] == 1) {
                $content .= '<li>' . $this->linkEditContent('Pagination: enabled', $row) . '</li>';
            }
            if ($row['tx_paginatedprocessors_itemsperpage'] && $row['tx_paginatedprocessors_paginationenabled'] == 1) {
                $content .= '<li>' . $this->linkEditContent($this->renderText('Items per page: ' . $row['tx_paginatedprocessors_itemsperpage']), $row) . '</li>';
            }
            if ($row['tx_paginatedprocessors_pagelinksshown'] && $row['tx_paginatedprocessors_paginationenabled'] == 1) {
                $content .= '<li>' . $this->linkEditContent($this->renderText('Links shown: ' . $row['tx_paginatedprocessors_pagelinksshown']), $row) . '</li>';
            }
            if ($row['tx_paginatedprocessors_urlsegment'] && $row['tx_paginatedprocessors_paginationenabled'] == 1) {
                $content .= '<li>' . $this->linkEditContent($this->renderText('URL segment: ' . $row['tx_paginatedprocessors_urlsegment']), $row) . '</li>';
            }
            if ($row['tx_paginatedprocessors_anchor'] && $row['tx_paginatedprocessors_paginationenabled'] == 1) {
                $content .= '<li>' . $this->linkEditContent($this->renderText('Anchor: yes'), $row) . '</li>';
            }
            if ($row['tx_paginatedprocessors_anchor'] && $row['tx_paginatedprocessors_anchorid'] && $row['tx_paginatedprocessors_paginationenabled'] == 1) {
                $content .= '<li>' . $this->linkEditContent($this->renderText('Custom Anchor: ' . $row['tx_paginatedprocessors_anchorid']), $row) . '</li>';
            }
            $content .= '</ul>';
        }
        return $content;

    }
}
