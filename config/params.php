<?php

$params = [
    'adminEmail' => 'admin@example.com',
];
$localParams = include('params-local.php');
$merged = array_merge($params, $localParams);

return $merged;
