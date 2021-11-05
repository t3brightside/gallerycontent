<?php
$EM_CONF[$_EXTKEY] = [
	'title' => 'Gallerycontent',
	'description' => 'Content element for image gallery with preset crop ratios',
	'category' => 'fe',
	'version' => '0.1.4',
	'state' => 'stable',
	'uploadfolder' => false,
	'createDirs' => '',
	'clearcacheonload' => true,
	'author' => 'Tanel Põld',
	'author_email' => 'tanel@brightside.ee',
	'author_company' => 'Brightside OÜ / t3brightside.com',
	'constraints' => [
		'depends' => [
			'typo3' => '11.5.0 - 11.5.99',
			'fluid_styled_content' => '',
		],
	],
];
