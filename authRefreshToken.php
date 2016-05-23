#!/usr/bin/env php
<?php

// Refresh a token if it's expired.

require_once './vendor/autoload.php';

$auth = json_decode(file_get_contents('auth.json'), true);
$token = json_decode(file_get_contents('token.json'), true);

if ($token['expires_at'] > time()) {
    echo "Current token is still good, not doing anything.\n";
    return;
}

echo "Current token is expired.\n";

$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://restapi.actonsoftware.com',
]);

$result = $client->post('/token', [
    'form_params' => [
        'grant_type' => 'refresh_token',
        'client_id' => $auth['client_id'],
        'client_secret' => $auth['client_secret'],
        'refresh_token' => $token['refresh_token'],
    ],
]);

if ($result->getStatusCode() === 200) {
    echo "Got a new token.\n";
    $data = json_decode($result->getBody(), true);
    $data['expires_at'] = time() + $data['expires_in'];
    file_put_contents('token.json', json_encode($data));
}
