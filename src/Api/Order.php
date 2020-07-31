<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Api;

use LWC\ActiveAnts\Exception;
use LWC\ActiveAnts\Exception\InvalidArgumentException;
use LWC\ActiveAnts\Model\Order\Order as Model;
use LWC\ActiveAnts\Model\Order\OrderItem;
use Psr\Http\Message\ResponseInterface;

final class Order extends HttpApi
{
    /**
     * @throws Exception
     *
     * @return Model|ResponseInterface
     */
    public function get(string $id)
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Id cannot be empty');
        }

        $response = $this->httpGet('/v2/order/search?externalOrderNumber='.$id);
        if (!$this->hydrator) {
            return $response;
        }

        var_dump($response->getBody()->__toString());
        // Use any valid status code here
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Model::class);
    }

    /**
     * @throws Exception
     *
     * @return Model|ResponseInterface
     */
    public function create(string $customer, string $channel, string $localeCode, array $params = [])
    {
        if (empty($customer)) {
            throw new InvalidArgumentException('Customers field cannot be empty');
        }

        if (empty($channel)) {
            throw new InvalidArgumentException('Channel cannot be empty');
        }

        if (empty($localeCode)) {
            throw new InvalidArgumentException('Locale code cannot be empty');
        }

        $params['customer'] = $customer;
        $params['channel'] = $channel;
        $params['localeCode'] = $localeCode;

        $response = $this->httpPost('/order/add', $params);
        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (201 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Model::class);
    }

    /**
     * @throws Exception
     *
     * @return OrderItem|ResponseInterface
     */
    public function addItem(int $cartId, string $variant, int $quantity)
    {
        if (empty($cartId)) {
            throw new InvalidArgumentException('Cart id field cannot be empty');
        }

        if (empty($variant)) {
            throw new InvalidArgumentException('variant cannot be empty');
        }

        if (empty($quantity)) {
            throw new InvalidArgumentException('quantity cannot be empty');
        }

        $params = [
            'variant' => $variant,
            'quantity' => $quantity,
        ];

        $response = $this->httpPost(\sprintf('/api/v1/carts/%d/items/', $cartId), $params);
        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (201 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, OrderItem::class);
    }
}
