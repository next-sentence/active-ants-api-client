<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Api;

final class Custom extends HttpApi
{
    public function get(string $path, array $params = [], array $requestHeaders = [], string $class = '')
    {
        $response = parent::httpGet($path, $params, $requestHeaders);
        var_dump($response->getStatusCode());
        if (!$this->hydrator) {
            return $response;
        }

        return $this->hydrator->hydrate($response, $class);
    }

    public function post(string $path, array $params = [], array $requestHeaders = [], string $class = '')
    {
        $response = parent::httpPost($path, $params, $requestHeaders);
        if (!$this->hydrator) {
            return $response;
        }

        return $this->hydrator->hydrate($response, $class);
    }

    public function postRaw(string $path, $body, array $requestHeaders = [], string $class = '')
    {
        $response = parent::httpPostRaw($path, $body, $requestHeaders);
        if (!$this->hydrator) {
            return $response;
        }

        return $this->hydrator->hydrate($response, $class);
    }

    public function put(string $path, array $params = [], array $requestHeaders = [], string $class = '')
    {
        $response = parent::httpPut($path, $params, $requestHeaders);
        if (!$this->hydrator) {
            return $response;
        }

        return $this->hydrator->hydrate($response, $class);
    }

    public function patch(string $path, array $params = [], array $requestHeaders = [], string $class = '')
    {
        $response = parent::httpPatch($path, $params, $requestHeaders);
        if (!$this->hydrator) {
            return $response;
        }

        return $this->hydrator->hydrate($response, $class);
    }

    public function delete(string $path, array $params = [], array $requestHeaders = [], string $class = '')
    {
        $response = parent::httpDelete($path, $params, $requestHeaders);
        if (!$this->hydrator) {
            return $response;
        }

        return $this->hydrator->hydrate($response, $class);
    }
}
