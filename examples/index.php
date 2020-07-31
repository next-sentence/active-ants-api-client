<?php

use LWC\ActiveAnts\ActiveAntsClient;
use LWC\ActiveAnts\Hydrator\ArrayHydrator;

require dirname(__DIR__).'/vendor/autoload.php';

$endpoint = 'https://shopapitest.activeants.nl/';

$username = 'coolgift_shopapitest';
$password = 'YwuN26bq7Ncy6Mnd';

$apiClient = ActiveAntsClient::create($endpoint);
$accessToken = $apiClient->createNewAccessToken($username, $password);
var_dump($accessToken);
$apiClient->authenticate($accessToken);
$result = $apiClient->custom(new ArrayHydrator())->get('settings/get');
$result = $apiClient->order()->get('test');

var_dump($result);
