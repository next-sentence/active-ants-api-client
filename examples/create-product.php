<?php

use LWC\ActiveAnts\ActiveAntsClient;

/** @var ActiveAntsClient $apiClient */
$apiClient = require 'get-client.php';

$product['Sku'] = 'skuTest3';
$product['Name'] = 'productTest3';

$result = $apiClient->product()->create($product);

var_dump($result);
