<?php
// Application middleware
$app->add(new \Restoo\Auth);
$app->add(new \Restoo\Compress);
$app->add(new \CorsSlim\CorsSlim());
