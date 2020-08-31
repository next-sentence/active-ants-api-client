<?php

use LWC\ActiveAnts\ActiveAntsClient;
use LWC\ActiveAnts\Hydrator\ArrayHydrator;

require_once dirname(__DIR__).'/vendor/autoload.php';

/** @var ActiveAntsClient $apiClient */
$apiClient = require 'get-client.php';

// get settings
$result = $apiClient->stock()->get();

var_dump($result->getMessageCode());
var_dump($result->getMessage());
var_dump($result->getResult());
