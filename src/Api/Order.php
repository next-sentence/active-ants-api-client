<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Api;

use LWC\ActiveAnts\Exception;
use LWC\ActiveAnts\Exception\InvalidArgumentException;
use LWC\ActiveAnts\Model\Order\Order as Model;
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
    public function create(array $order = [])
    {
        if (empty($order['ExternalOrderNumber'])) {
            throw new InvalidArgumentException('External Order Number field cannot be empty');
        }

        if (empty($order['Email'])) {
            throw new InvalidArgumentException('Email cannot be empty');
        }

        if (empty($order['PhoneNumber'])) {
            throw new InvalidArgumentException('Phone Number code cannot be empty');
        }

        if (empty($order['PaymentMethodId'])) {
            throw new InvalidArgumentException('Payment Method code cannot be empty');
        }

        if (empty($order['ShippingMethodId'])) {
            throw new InvalidArgumentException('Shipping Method code cannot be empty');
        }

        if (empty($order['DeliveryAddressStreet'])) {
            throw new InvalidArgumentException('Delivery Address Street code cannot be empty');
        }

        if (empty($order['DeliveryAddressCityName'])) {
            throw new InvalidArgumentException('Delivery Address City Name code cannot be empty');
        }

        if (empty($order['DeliveryAddressCountryIso'])) {
            throw new InvalidArgumentException('Delivery Address Country Iso code cannot be empty');
        }

        if (empty($order['LanguageId'])) {
            throw new InvalidArgumentException('Language code cannot be empty');
        }

        if (empty($order['OrderTypeId'])) {
            throw new InvalidArgumentException('Order Type code cannot be empty');
        }

        if (empty($order['OrderItems'])) {
            throw new InvalidArgumentException('Order Items code cannot be empty');
        }

        //var_dump($order); die();


        $response = $this->httpPost('/order/add', $order);
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
