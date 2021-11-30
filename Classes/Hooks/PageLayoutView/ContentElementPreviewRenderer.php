<?php
namespace Brightside\Gallerycontent\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;

class ContentElementPreviewRenderer implements PageLayoutViewDrawItemHookInterface {
	 /**
     * Preprocesses the preview rendering of a content element of type "textmedia"
     *
     * @param \TYPO3\CMS\Backend\View\PageLayoutView $parentObject Calling parent object
     * @param bool $drawItem Whether to draw the item using the default functionality
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     *
     * @return void
     */

	 public function preProcess(PageLayoutView &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row) {
		if ($row['CType'] === 'gallerycontent') {
			if ($row['assets']) {
                $itemContent .= $parentObject->linkEditContent($parentObject->getThumbCodeUnlinked($row, 'tt_content', 'assets'), $row);
                $fileReferences = \TYPO3\CMS\Backend\Utility\BackendUtility::resolveFileReferences('tt_content', 'assets', $row);
                if (!empty($fileReferences)) {
                    $linkedContent = '';
                    $itemContent .= $parentObject->linkEditContent($linkedContent, $row);
                    unset($linkedContent);
                }
            }
			$itemContent .= '<ul style="margin: 0; margin-top: 0.5em; padding: 0.2em 1.4em;">';
            if ($row['tx_gallerycontent_template'] != 0) {
                $itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText('Template: ' . $row['tx_gallerycontent_template']), $row) . '</li>';
            }
            if ($row['tx_gallerycontent_showtitle'] === 1) {
				$itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText('Show titles: yes'), $row) . '</li>';
			}
			if ($row['tx_gallerycontent_showdesc'] === 1) {
				$itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText('Show descriptions: yes'), $row) . '</li>';
			}
			$itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText('Image crop: ' . $row['tx_gallerycontent_cropratio']), $row) . '</li>';
			if ($row['image_zoom'] === 1) {
				$itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText('Click-enlarge: yes'), $row) . '</li>';
			}
			if ($row['image_zoom'] === 1) {
				$itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText('Click-enlarge crop: ' . $row['tx_gallerycontent_cropratiozoom']), $row) . '</li>';
			}
            if ($row['tx_paginatedprocessors_paginationenabled'] == 1) {
                $itemContent .= '<li>' . $parentObject->linkEditContent('Pagination: enabled', $row) . '</li>';
            }
            if ($row['tx_paginatedprocessors_itemsperpage'] && $row['tx_paginatedprocessors_paginationenabled'] == 1) {
                $itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText('Items per page: ' . $row['tx_paginatedprocessors_itemsperpage']), $row) . '</li>';
            }
            if ($row['tx_paginatedprocessors_pagelinksshown'] && $row['tx_paginatedprocessors_paginationenabled'] == 1) {
                $itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText('Links shown: ' . $row['tx_paginatedprocessors_pagelinksshown']), $row) . '</li>';
            }
            if ($row['tx_paginatedprocessors_urlsegment'] && $row['tx_paginatedprocessors_paginationenabled'] == 1) {
                $itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText('URL segment: ' . $row['tx_paginatedprocessors_urlsegment']), $row) . '</li>';
            }
            if ($row['tx_paginatedprocessors_anchor'] && $row['tx_paginatedprocessors_paginationenabled'] == 1) {
                $itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText('Anchor: yes'), $row) . '</li>';
            }
            if ($row['tx_paginatedprocessors_anchor'] && $row['tx_paginatedprocessors_anchorid'] && $row['tx_paginatedprocessors_paginationenabled'] == 1) {
                $itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText('Custom Anchor: ' . $row['tx_paginatedprocessors_anchorid']), $row) . '</li>';
            }
			$itemContent .= '</ul>';
			$drawItem = FALSE;
		}
	}
}
