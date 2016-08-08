#!/usr/bin/env php
<?php

// Get the list of subscription categories.

require_once './vendor/autoload.php';

$token = json_decode(file_get_contents('token.json'), true);

$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://restapi.actonsoftware.com',
    'headers' => [
        'Authorization' => 'Bearer ' . $token['access_token'],
    ]
]);

$result = $client->get('/api/1/subscription/category');

print_r(json_decode($result->getBody(), true));
