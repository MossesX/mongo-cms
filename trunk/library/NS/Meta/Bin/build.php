#!/usr/bin/php
<?php

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(dirname(__FILE__) . '/../../../'),
    get_include_path(),
)));

spl_autoload_register(function($name){
	require_once $name.'.php';
});

use \NS;
use \NS\Cli;
use \NS\Cli\Process;
use \NS\Cli\Option;
use \NS\Meta;
use \NS\Meta\Builder;

$cli = new Process();
$cli
	->addOption(Option::create()->setName('p')->setRequired(true)->setMan('Models path'))
	->ln()
	->write('Models builder started')->ln()->ln()
	->write('Checking config... ');

$arguments = $cli->getArguments();

// Models path
$modelsPath = realpath($arguments['p']);
if (!file_exists($modelsPath))
	$cli->stop("Path '{$arguments['p']}' ('$modelsPath') wasn't found");

// Meta.xml
$metaFileName = $arguments['f'];
if (!file_exists($metaFileName))
	$cli->stop("Meta filename '$metaFileName' wasn't found");

$cli->write('ok')->ln();

try
{
	$builder = Builder::create()
		->setFileName($metaFileName)
		->build();
}
catch (\NS\Core\Exception $e)
{
	$cli->stop($e->getMessage());
}

$cli->ln()->write('Finished')->ln()->ln();
