<?php
require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Twig templating system
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/views',
));

// For setting the url address
//$static_url = "http://{$_SERVER['SERVER_NAME']}";

// Our web handlers

$app->get('/', function() use($app) {
  //$app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig', array(
    'STATIC_URL' => "http://{$_SERVER['SERVER_NAME']}" //usage {{ STATIC_URL }} in template
  ));
});

$app->get('/webcast', function() use($app) {
  //$app['monolog']->addDebug('logging output.');
  return $app['twig']->render('live-stream.twig', array(
    'STATIC_URL' => "http://{$_SERVER['SERVER_NAME']}" //usage {{ STATIC_URL }} in template
  ));
});

$app->run();

?>
