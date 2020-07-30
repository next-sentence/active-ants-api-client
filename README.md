# ActiveAnts API client

## Install

Via Composer

``` bash
$ composer require next-sentence/active-ants-api-client
```

## Usage

``` php
$apiClient = ActiveAntsClient::create($endpoint);
$accessToken = $apiClient->createNewAccessToken($username, $password);
$apiClient->authenticate($accessToken);
$result = $apiClient->custom(new ArrayHydrator())->get('settings/get');
```
