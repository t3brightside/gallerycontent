<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Gallerycontent',
    'description' => 'Content element for image gallery with preset crop ratios and pagination',
    'category' => 'fe',
    'version' => '1.5.0',
    'state' => 'stable',
    'clearcacheonload' => true,
    'author' => 'Tanel Põld',
    'author_email' => 'tanel@brightside.ee',
    'author_company' => 'Brightside OÜ / t3brightside.com',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0 - 12.99.99',
            'fluid_styled_content' => '11.5.0 - 12.99.99',
            'paginatedprocessors' => '1.3.1 - 1.99.99',
        ],
    ],
    'autoload' => [
         'psr-4' => [
                'Brightside\\Gallerycontent\\' => 'Classes'
         ]
    ],
];
