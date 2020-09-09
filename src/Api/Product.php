<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Api;

use LWC\ActiveAnts\Exception;
use LWC\ActiveAnts\Exception\InvalidArgumentException;
use LWC\ActiveAnts\Model\Product\Product as Model;
use Psr\Http\Message\ResponseInterface;

final class Product extends HttpApi
{
    /**
     * @return Model|ResponseInterface
     * @throws \Psr\Http\Client\ClientExceptionInterface
     *
     * @throws Exception
     */
    public function create(array $product = [])
    {
        if (empty($product['Sku'])) {
            throw new InvalidArgumentException('Sku field cannot be empty');
        }

        if (empty($product['Name'])) {
            throw new InvalidArgumentException('Name field cannot be empty');
        }

        $response = $this->httpGet('/v2/product/search?sku='.$product['Sku']);

        $search = $this->hydrator->hydrate($response, Model::class);

        if($search->getReturnCode()) {
            $response = $this->httpPost('/product/edit', $product);
        } else {
            $response = $this->httpPost('/product/add', $product);
        }

        // Use any valid status code here
        if (!in_array($response->getStatusCode(), [200, 201], true) ) {
            $this->handleErrors($response);
        }

        if ($this->hydrator) {
            return $this->hydrator->hydrate($response, Model::class);
        }

        return $response;
    }
}
