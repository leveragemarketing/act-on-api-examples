#!/usr/bin/env php
<?php

// Login and get a new token.

require_once './vendor/autoload.php';

$auth = json_decode(file_get_contents('auth.json'), true);

$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://restapi.actonsoftware.com',
]);

$result = $client->post('/token', [
    'form_params' => [
        'grant_type' => 'password',
        'username' => $auth['username'],
        'password' => $auth['password'],
        'client_id' => $auth['client_id'],
        'client_secret' => $auth['client_secret'],
    ],
]);

if ($result->getStatusCode() === 200) {
    echo "Got a new token.\n";
    $data = json_decode($result->getBody(), true);
    $data['expires_at'] = time() + $data['expires_in'];
    file_put_contents('token.json', json_encode($data));
}
