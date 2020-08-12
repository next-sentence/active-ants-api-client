<?php

use LWC\ActiveAnts\ActiveAntsClient;

/** @var ActiveAntsClient $apiClient */
$apiClient = require 'get-client.php';

$result = $apiClient->order()->get('112233');

var_dump($result);
