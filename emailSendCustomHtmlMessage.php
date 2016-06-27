#!/usr/bin/env php
<?php

// Send a custom HTML email message.

$listId = 'l-0001';
$contactId = 2;
$categoryId = 2;
$senderName = 'Foo Bar';
$senderEmail = 'foo@bar.com';

require_once './vendor/autoload.php';

$token = json_decode(file_get_contents('token.json'), true);

$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://restapi.actonsoftware.com',
    'headers' => [
        'Authorization' => 'Bearer ' . $token['access_token'],
    ]
]);

$result = $client->post('/api/1/message/custom/send', [
    'form_params' => [
        'title' => 'api test ' . date('r'),
        'iscustom' => 'Y',
        'istextonly' => 'N',
        'senderemail' => $senderEmail,
        'sendername' => $senderName,
        'sendtorecids' => $listId . ':' . $contactId,
        'when' => time(),
        'subject' => 'this is the subject of a custom message',
        'textbody' => 'this is the text body of a custom message',
        'htmlbody' => '<h1>this is the html body of a custom message</h1>',
        'categoryid' => $categoryId,
    ],
]);

print_r(json_decode($result->getBody(), true));
