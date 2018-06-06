<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app->post('[/{route:.*}]', \Restoo\Restoo::class);
