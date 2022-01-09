<?php
$loader = require_once __DIR__.'/../app/bootstrap.php.cache';
// Debug::enable();
require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();

$request = Sonata\PageBundle\Request\RequestFactory::createFromGlobals('host_with_path');
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
