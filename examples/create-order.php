<?php

use LWC\ActiveAnts\ActiveAntsClient;

/** @var ActiveAntsClient $apiClient */
$apiClient = require 'get-client.php';

// create order
$items[] = [
    "Sku" => "testSku",
    "Name" => "test Product 6",
    "Price" => "3.9800",
    "Quantity" => 1,
    "Vat" => 0.21
];

$order['ExternalOrderNumber'] = 112244;
$order['Email'] = 'john.doe@example.com';
$order['PhoneNumber'] = '+37379123456';
$order['PaymentMethodId'] = 14;
$order['ShippingMethodId'] = 90155;
$order['DeliveryAddressLastName'] = 'John';
$order['DeliveryAddressStreet'] = 'Doe';
$order['DeliveryAddressCityName'] = 'Chisinau';
$order['DeliveryAddressCountryIso'] = 'MD';
$order['LanguageId'] = '2';
$order['OrderTypeId'] = 1623;
$order['OrderItems'] = $items;

$result = $apiClient->order()->create($order);

var_dump($result);
