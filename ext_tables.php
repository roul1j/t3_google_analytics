<?php
defined('TYPO3_MODE') || die();

if (TYPO3_MODE === 'BE' && !(TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL)) {
	// Regular SOBE Module
	TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule(
		'web',
		'txt3googleanalytics',
		'bottom',
		'',
		[
			'name' => 'web_txt3googleanalytics',
			'access' => 'user,group',
			'routeTarget' => \JR\T3GoogleAnalytics\Modules\GoogleAnalyticsController::class . '::processRequest',
			'workspaces' => 'online',
			'labels' => array(
				'll_ref' => 'LLL:EXT:t3_google_analytics/Resources/Private/Language/locallang.xlf',
				'tabs_images' => [
					'tab' => 'EXT:t3_google_analytics/Resources/Public/Icons/T3GoogleAnalytics.svg'
				],
			),
		]
	);
}
