#!/usr/bin/env php
<?php

// Insert a new fact.

$type = 'foo';
$value = 'bar';
$email = 'foo@bar.com';
$date = '01/01/2016';

require_once './vendor/autoload.php';

$token = json_decode(file_get_contents('token.json'), true);

$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://restapi.actonsoftware.com',
    'headers' => [
        'Authorization' => 'Bearer ' . $token['access_token'],
    ]
]);

$result = $client->post('/api/1/customevents', [
    'multipart' => [
        [
            'name' => 'destination',
            'contents' => $type,
        ],
        [
            'name' => 'firstrow',
            'contents' => 'N',
        ],
        [
            'name' => 'fieldseparator',
            'contents' => 'COMMA',
        ],
        [
            'name' => 'quotecharacter',
            'contents' => 'DOUBLE_QUOTE',
        ],
        [
            'name' => 'customeventaction',
            'contents' => 'CUSTOM_GENERAL',
        ],
        [
            'name' => 'emailcolidx',
            'contents' => 0,
        ],
        [
            'name' => 'datecolidx',
            'contents' => 1,
        ],
        [
            'name' => 'titlecolidx',
            'contents' => 2,
        ],
        [
            'name' => 'dateformat',
            'contents' => 'MM/dd/yyyy',
        ],
        [
            'name' => 'file',
            'contents' => sprintf('"%s","%s","%s"', $email, $date, $value),
            'filename' => 'fact.csv',
        ],
    ],
]);

$result = json_decode($result->getBody(), true);
print_r($result);
