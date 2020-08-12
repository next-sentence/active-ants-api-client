<?php

declare(strict_types=1);

use LWC\ActiveAnts\ActiveAntsClient;

require_once dirname(__DIR__).'/vendor/autoload.php';

$endpoint = getenv('ACTIVE_ANTS_ENDPOINT');
$username = getenv('ACTIVE_ANTS_USERNAME');
$password = getenv('ACTIVE_ANTS_PASSWORD');

$apiClient = ActiveAntsClient::create($endpoint);
$accessToken = $apiClient->createNewAccessToken($username, $password);
$apiClient->authenticate($accessToken);

return $apiClient;
