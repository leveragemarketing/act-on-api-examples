#!/usr/bin/env php
<?php

// Create / update a contact.

$listId = 'l-0001';
$email = 'foo@bar.com';

require_once './vendor/autoload.php';

$token = json_decode(file_get_contents('token.json'), true);

$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://restapi.actonsoftware.com',
    'headers' => [
        'Authorization' => 'Bearer ' . $token['access_token'],
    ]
]);

$result = $client->put('/api/1/list/' . urlencode($listId) . '/record?email=' . $email, [
    'json' => [
        'First Name' => 'Foo',
        'Last Name' => 'Bar',
    ],
]);

print_r(json_decode($result->getBody(), true));
