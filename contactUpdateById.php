#!/usr/bin/env php
<?php

// Update a contact by its internal Act-On record ID.

$listId = 'l-0001';
$contactId = '2';

require_once './vendor/autoload.php';

$token = json_decode(file_get_contents('token.json'), true);

$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://restapi.actonsoftware.com',
    'headers' => [
        'Authorization' => 'Bearer ' . $token['access_token'],
    ]
]);

$result = $client->put('/api/1/list/' . urlencode($listId) . '/record/' . urlencode($listId . ':' . $contactId), [
    'json' => [
        'E-mail Address' => 'foo@bar.com',
        'First Name' => 'Foo',
        'Last Name' => 'Bar',
    ],
]);

print_r(json_decode($result->getBody(), true));
