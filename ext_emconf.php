<?php
$EM_CONF[$_EXTKEY] = [
	'title' => 'Gallerycontent',
	'description' => 'Content element for image gallery with preset crop ratios',
	'category' => 'fe',
	'version' => '0.1.0',
	'state' => 'stable',
	'uploadfolder' => false,
	'createDirs' => '',
	'clearcacheonload' => true,
	'author' => 'Tanel Põld',
	'author_email' => 'tanel@brightside.ee',
	'author_company' => 'Brightside OÜ / t3brightside.com',
	'constraints' => [
		'depends' => [
			'typo3' => '9.5.0 - 10.4.99',
			'fluid_styled_content' => '',
		],
	],
];
