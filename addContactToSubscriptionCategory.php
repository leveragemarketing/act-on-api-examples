#!/usr/bin/env php
<?php

// Add a contact to a subscription category.

$email = 'foo@bar.com';
$category = 'Home Search Alerts';

require_once './vendor/autoload.php';

$token = json_decode(file_get_contents('token.json'), true);

$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://restapi.actonsoftware.com',
    'headers' => [
        'Authorization' => 'Bearer ' . $token['access_token'],
    ]
]);

$result = $client->put('/api/1/subscription/optout', [
    'form_params' => [
        'email' => $email,
        'category' => $category,
        'action' => 'optin',
    ],
]);

print_r(json_decode($result->getBody(), true));
