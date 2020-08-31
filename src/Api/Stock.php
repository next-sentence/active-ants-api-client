<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Api;

use LWC\ActiveAnts\Exception;
use LWC\ActiveAnts\Model\Stock\Stock as Model;
use Psr\Http\Message\ResponseInterface;

final class Stock extends HttpApi
{
    /**
     * @return Model|ResponseInterface
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws Exception
     */
    public function get()
    {

        $response = $this->httpGet('/stock/bulk/true');
        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Model::class);
    }
}
