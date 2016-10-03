#!/usr/bin/env php
<?php

// Create a new contact.

$listId = 'l-0001';

require_once './vendor/autoload.php';

$token = json_decode(file_get_contents('token.json'), true);

$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://restapi.actonsoftware.com',
    'headers' => [
        'Authorization' => 'Bearer ' . $token['access_token'],
    ]
]);

$result = $client->post('/api/1/list/' . urlencode($listId) . '/record/', [
    'json' => [
        'E-mail Address' => 'foo@bar.com',
        'First Name' => 'Foo',
        'Last Name' => 'Bar',
    ],
]);

print_r(json_decode($result->getBody(), true));
