#!/usr/bin/env php
<?php

// Get a list of lists.

require_once './vendor/autoload.php';

$token = json_decode(file_get_contents('token.json'), true);

$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://restapi.actonsoftware.com',
    'headers' => [
        'Authorization' => 'Bearer ' . $token['access_token'],
    ]
]);

$result = json_decode($client->get('/api/1/list')->getBody(), true);
printf("There are %d lists:\n", $result['totalCount']);
foreach ($result['result'] as $list) {
    printf("  [%s] %s\n", $list['id'], $list['name']);
}
