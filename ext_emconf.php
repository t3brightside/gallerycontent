<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Gallerycontent',
    'description' => 'Content element for image gallery with preset crop ratios and pagination',
    'category' => 'fe',
    'version' => '3.0.0',
    'state' => 'stable',
    'clearcacheonload' => true,
    'author' => 'Tanel Põld',
    'author_email' => 'tanel@brightside.ee',
    'author_company' => 'Brightside OÜ / t3brightside.com',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0 - 14.9.99',
            'fluid_styled_content' => '13.4.0 - 14.9.99',
            'paginatedprocessors' => '1.7.0 - 1.9.99',
            'embedassets' => '1.4.0-1.9.99',
        ],
    ],
];
