#!/usr/bin/env php
<?php

if (version_compare(PHP_VERSION, '7.4.0', '<')) {
    echo 'Please use php version 7.4 or higher. Your version is: ' . PHP_VERSION . "\n";
    exit;
}

if (!class_exists(\XMLReader::class)) {
    echo 'Please install extension "xmlreader"' . "\n";
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use TestTask\Command\XmlJsonConverterCommand;

$command = new XmlJsonConverterCommand();
$application = new Application();
$application->add($command);
$application->setDefaultCommand($command->getName(), true);
$application->run();
