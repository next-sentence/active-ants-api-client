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
     * @throws Exception
     *
     * @return Model|ResponseInterface
     */
    public function create(array $product = [])
    {
        if (empty($product['Sku'])) {
            throw new InvalidArgumentException('Sku field cannot be empty');
        }

        if (empty($product['Name'])) {
            throw new InvalidArgumentException('Name field cannot be empty');
        }

        $response = $this->httpPost('/product/add', $product);
        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (201 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Model::class);
    }
}
