<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->libraryDir,
        $config->application->formsDir,
        $config->application->helpersDir,
    )
)->register();

//RB
//Register some namespaces
$loader->registerNamespaces(
    array(
        "Twm\Db\Adapter\Pdo" => $config->application->libraryDir . "db/adapter/",
        "Twm\Db\Dialect"     => $config->application->libraryDir . "db/dialect/",
        "Primaedu\Mail"   => $config->application->libraryDir,
        "Primaedu\Excel"  => $config->application->libraryDir,
    )
)->register();
