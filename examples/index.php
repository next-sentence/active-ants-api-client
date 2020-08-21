<?php

use LWC\ActiveAnts\ActiveAntsClient;
use LWC\ActiveAnts\Hydrator\ArrayHydrator;

require dirname(__DIR__).'/vendor/autoload.php';

$endpoint = 'https://shopapitest.activeants.nl/';

$username = 'coolgift_shopapitest';
$password = 'YwuN26bq7Ncy6Mnd';

$apiClient = ActiveAntsClient::create($endpoint);
$accessToken = $apiClient->createNewAccessToken($username, $password);
$apiClient->authenticate($accessToken);
$result = $apiClient->custom(new ArrayHydrator())->get('settings/get');

var_dump($result['result']['shippingMethods']); die();
//$result = $apiClient->order()->get('112233');

$order = array();
$items = array();

$items[] = [
            "Sku" => "testSku",
            "Name" => "test Product 6",
            "Price" => "3.9800",
            "Quantity" => 1,
            "Vat" => 0.21
        ];

$order['ExternalOrderNumber'] = 12345677;
$order['Email'] = 'bodarev@ilab.md';
$order['PhoneNumber'] = '+37379038313';
$order['PaymentMethodId'] = 1;
$order['ShippingMethodId'] = 90155;
$order['DeliveryAddressLastName'] = 'Vasile';
$order['DeliveryAddressStreet'] = 'Cucorilor';
$order['DeliveryAddressCityName'] = 'Chisinau';
$order['DeliveryAddressCountryIso'] = 'MD';
$order['LanguageId'] = '2';
$order['OrderTypeId'] = 1623;
$order['OrderItems'] = $items;

//$result = $apiClient->order()->create($order);

//var_dump($result);

$product['Sku'] = 'skuTest3';
$product['Name'] = 'productTest3';

$result = $apiClient->product()->create($product);

var_dump($result);

