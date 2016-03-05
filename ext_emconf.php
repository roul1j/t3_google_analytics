<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 Google Analytics',
    'description' => 'Google Analytics backend module for TYPO3.',
    'category' => 'misc',
    'constraints' => [
        'depends' => [
            'php' => '5.5.0-7.99.99',
            'typo3' => '7.5.0-8.99.99'
        ]
    ],
    'autoload' => [
        'psr-4' => [
            'JR\\T3GoogleAnalytics\\' => 'Classes'
        ]
    ],
    'state' => 'stable',
    'author' => 'Jérémie Roulin',
    'author_email' => 'me@jeremie-roulin.ch',
    'version' => '1.0.0'
];
