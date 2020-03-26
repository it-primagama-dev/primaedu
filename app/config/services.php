<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Primaedu\Mail\Mail;
use Primaedu\Excel\Excel;


/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
}, true);

/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ));

            $compiler = $volt->getCompiler();
            $compiler->addFunction('is_a', 'is_a');
            $compiler->addFunction('strtotime', 'strtotime');
            $compiler->addFilter('number_format', 'number_format');

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
//    return new DbAdapter(array(
//        'host' => $config->database->host,
//        'username' => $config->database->username,
//        'password' => $config->database->password,
//        'dbname' => $config->database->dbname,
//        "charset" => $config->database->charset
//    ));
// RB
    return new Twm\Db\Adapter\Pdo\Mssql([
        'host' => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname' => $config->database->dbname,
        'pdoType' => $config->database->pdoType,
        'dialectClass' => $config->database->dialectClass
    ]);
});


//database 2
$di->set('db2', function () use ($config) {
//    return new DbAdapter(array(
//        'host' => $config->database->host,
//        'username' => $config->database->username,
//        'password' => $config->database->password,
//        'dbname' => $config->database->dbname,
//        "charset" => $config->database->charset
//    ));
// RB
    return new Twm\Db\Adapter\Pdo\Mssql([
        'host' => $config->database2->host,
        'username' => $config->database2->username,
        'password' => $config->database2->password,
        'dbname' => $config->database2->dbname,
        'pdoType' => $config->database2->pdoType,
        'dialectClass' => $config->database2->dialectClass
    ]);
});

//database 3 (PrimaDB)
$di->set('db3', function () use ($config) {
    return new Twm\Db\Adapter\Pdo\Mssql([
        'host' => $config->database3->host,
        'username' => $config->database3->username,
        'password' => $config->database3->password,
        'dbname' => $config->database3->dbname,
        'pdoType' => $config->database3->pdoType,
        'dialectClass' => $config->database3->dialectClass
    ]);
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter(
            array(
        'uniqueId' => 'primaedu-apps'
            )
    );
    $session->start();

    return $session;
});

/**
 * Register the flash service with custom CSS classes
 */
$di->set('flash', function() {
    return new FlashSession(array(
        'error' => 'alert alert-dismissible alert-danger fg-red',
        'success' => 'alert alert-dismissible alert-success',
        'notice' => 'alert alert-dismissible alert-info',
    ));
});

/*
 * Register Custom Sidebar
 */
$di->set('sidebar', function() {
    return new Sidebar();
});

/*
 * Register Custom Email Service
 */
$di->set('mail', function() {
    return new Mail();
});

/*
 * Register Custom Excel Service
 */
$di->set('excel', function() {
    return new Excel();
});

/**
 * Register Data Caching 
 */
$di->set('dataCache', function() use ($config) {
    $lifetime = 60*60; // 1 hour
    if ($config->development) {
        $lifetime = 60; // 1 min
    }

    $frontCache = new \Phalcon\Cache\Frontend\Data([
        "lifetime" => $lifetime
    ]);

    $cache = new \Phalcon\Cache\Backend\File($frontCache, [
        "cacheDir" => $config->application->cache_dir
    ]);

    return $cache;
});

/**
 * Register API Config
 */
$di->set('apiConfig', function() use ($config) {
    return $config->api;
});
/**
 * Register Refund Config
 */
$di->set('refundConfig', function() use ($config) {
    return $config->refund;
});
$di->set('environmentConfig', function() use ($config) {
    return $config->environment;
});

$di->set(
    'Number',
    function () {
        return new Number();
    }
);

