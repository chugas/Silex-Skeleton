<?php

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;

$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());

// TWIG
$app->register(new TwigServiceProvider(), array(
    'twig.options'        => array(
        'cache'            => isset($app['twig.options.cache']) ? $app['twig.options.cache'] : false,
        'strict_variables' => true
    ),
    'twig.path'           => $app['twig.path']
));
$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
}));

// PROFILER + LOGS
if ($app['debug']) {
  $app->register(new MonologServiceProvider(), array(
      'monolog.logfile' => __DIR__.'/../resources/var/logs/silex_dev.log',
  ));

  $app->register($p = new WebProfilerServiceProvider(), array(
      'profiler.cache_dir' => __DIR__.'/../resources/var/cache/profiler',
  ));
  $app->mount('/_profiler', $p);
}

return $app;
