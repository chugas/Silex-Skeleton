<?php

// configure your app for the production environment

$app['twig.path'] = array(__DIR__.'/../views');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');

// Doctrine (db)
/*$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'dbname'   => 'itsuccess',
    'user'     => 'root',
    'password' => '12345',
);*/

// enable the debug mode
$app['debug'] = true;