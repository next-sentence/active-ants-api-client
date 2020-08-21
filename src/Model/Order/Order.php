<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Model\Order;

use LWC\ActiveAnts\Model\CreatableFromArray;
use phpDocumentor\Reflection\Types\Integer;

final class Order implements CreatableFromArray
{
    /**
     * @var string
     */
    private $ExternalOrderNumber;

    /**
     * @var string
     */
    private $PreferredShippingDate;

    /**
     * @var string
     */
    private $Email;

    /**
     * @var string
     */
    private $PhoneNumber;

    /**
     * @var string
     */
    private $LanguageId;

    /**
     * @var integer
     */
    private $OrderTypeId;

    /**
     * @var integer
     */
    private $PaymentMethodId;

    /**
     * @var integer
     */
    private $ShippingMethodId;

    /**
     * @var string
     */
    private $BillingAddressFirstName;

    /**
     * @var string
     */
    private $BillingAddressLastName;

    /**
     * @var string
     */
    private $BillingAddressPostalCode;

    /**
     * @var string
     */
    private $BillingAddressStreet;

    /**
     * @var string
     */
    private $BillingAddressHouseNumber;

    /**
     * @var string
     */
    private $BillingAddressHouseNumberAddition;

    /**
     * @var string
     */
    private $BillingAddressCityName;

    /**
     * @var string
     */
    private $BillingAddressCountryIso;

    /**
     * @var string
     */
    private $DeliveryAddressFirstName;

    /**
     * @var string
     */
    private $DeliveryAddressLastName;

    /**
     * @var string
     */
    private $DeliveryAddressPostalCode;

    /**
     * @var string
     */
    private $DeliveryAddressStreet;

    /**
     * @var string
     */
    private $DeliveryAddressHouseNumber;

    /**
     * @var string
     */
    private $DeliveryAddressHouseNumberAddition;

    /**
     * @var string
     */
    private $DeliveryAddressCityName;

    /**
     * @var string
     */
    private $DeliveryAddressCountryIso;


    /**
     * @var OrderItem[]
     */
    private $OrderItems;

    /**
    * @var array
    */
    private $data;

    /**
     * Order constructor.
     * @param string $ExternalOrderNumber
     * @param string $PreferredShippingDate
     * @param string $Email
     * @param string $PhoneNumber
     * @param string $LanguageId
     * @param int $OrderTypeId
     * @param int $PaymentMethodId
     * @param int $ShippingMethodId
     * @param string $BillingAddressFirstName
     * @param string $BillingAddressLastName
     * @param string $BillingAddressPostalCode
     * @param string $BillingAddressStreet
     * @param string $BillingAddressHouseNumber
     * @param string $BillingAddressHouseNumberAddition
     * @param string $BillingAddressCityName
     * @param string $BillingAddressCountryIso
     * @param string $DeliveryAddressFirstName
     * @param string $DeliveryAddressLastName
     * @param string $DeliveryAddressPostalCode
     * @param string $DeliveryAddressStreet
     * @param string $DeliveryAddressHouseNumber
     * @param string $DeliveryAddressHouseNumberAddition
     * @param string $DeliveryAddressCityName
     * @param string $DeliveryAddressCountryIso
     * @param array $OrderItems,
     * @param array $data
     */
    private function __construct(
        string $ExternalOrderNumber,
        string $PreferredShippingDate,
        string $Email,
        string $PhoneNumber,
        string $LanguageId,
        int $OrderTypeId,
        int $PaymentMethodId,
        int $ShippingMethodId,
        string $BillingAddressFirstName,
        string $BillingAddressLastName,
        string $BillingAddressPostalCode,
        string $BillingAddressStreet,
        string $BillingAddressCityName,
        string $BillingAddressHouseNumber,
        string $BillingAddressHouseNumberAddition,
        string $BillingAddressCountryIso,
        string $DeliveryAddressFirstName,
        string $DeliveryAddressLastName,
        string $DeliveryAddressPostalCode,
        string $DeliveryAddressStreet,
        string $DeliveryAddressCityName,
        string $DeliveryAddressHouseNumber,
        string $DeliveryAddressHouseNumberAddition,
        string $DeliveryAddressCountryIso,
        array $OrderItems,
        array $data
    ) {
        $this->ExternalOrderNumber = $ExternalOrderNumber;
        $this->PreferredShippingDate = $PreferredShippingDate;
        $this->Email = $Email;
        $this->PhoneNumber = $PhoneNumber;
        $this->LanguageId = $LanguageId;
        $this->OrderTypeId = $OrderTypeId;
        $this->PaymentMethodId = $PaymentMethodId;
        $this->ShippingMethodId = $ShippingMethodId;
        $this->BillingAddressFirstName = $BillingAddressFirstName;
        $this->BillingAddressLastName = $BillingAddressLastName;
        $this->BillingAddressPostalCode = $BillingAddressPostalCode;
        $this->BillingAddressStreet = $BillingAddressStreet;
        $this->BillingAddressHouseNumber = $BillingAddressHouseNumber;
        $this->BillingAddressHouseNumberAddition = $BillingAddressHouseNumberAddition;
        $this->BillingAddressCityName = $BillingAddressCityName;
        $this->BillingAddressCountryIso = $BillingAddressCountryIso;
        $this->DeliveryAddressFirstName = $DeliveryAddressFirstName;
        $this->DeliveryAddressLastName = $DeliveryAddressLastName;
        $this->DeliveryAddressPostalCode = $DeliveryAddressPostalCode;
        $this->DeliveryAddressStreet = $DeliveryAddressStreet;
        $this->DeliveryAddressHouseNumber = $DeliveryAddressHouseNumber;
        $this->DeliveryAddressHouseNumberAddition = $DeliveryAddressHouseNumberAddition;
        $this->DeliveryAddressCityName = $DeliveryAddressCityName;
        $this->DeliveryAddressCountryIso = $DeliveryAddressCountryIso;
        $this->OrderItems = $OrderItems;
        $this->data = $data;
    }

    /**
     * @return Order
     */
    public static function createFromArray(array $data): self
    {
        $ExternalOrderNumber = '';
        if (isset($data['ExternalOrderNumber'])) {
            $ExternalOrderNumber = $data['ExternalOrderNumber'];
        }

        $PreferredShippingDate = date('Y-m-d');
        if (isset($data['PreferredShippingDate'])) {
            $PreferredShippingDate = $data['PreferredShippingDate'];
        }

        $Email = '';
        if (isset($data['Email'])) {
            $Email = $data['Email'];
        }

        $PhoneNumber = '';
        if (isset($data['PhoneNumber'])) {
            $PhoneNumber = $data['PhoneNumber'];
        }

        $LanguageId = '';
        if (isset($data['LanguageId'])) {
            $LanguageId = $data['LanguageId'];
        }

        $OrderTypeId = 0;
        if (isset($data['OrderTypeId'])) {
            $OrderTypeId = $data['OrderTypeId'];
        }

        $PaymentMethodId = 0;
        if (isset($data['PaymentMethodId'])) {
            $PaymentMethodId = $data['PaymentMethodId'];
        }

        $ShippingMethodId = 0;
        if (isset($data['ShippingMethodId'])) {
            $ShippingMethodId = $data['ShippingMethodId'];
        }

        $BillingAddressFirstName = '';
        if (isset($data['BillingAddressFirstName'])) {
            $BillingAddressFirstName = $data['BillingAddressFirstName'];
        }

        $BillingAddressLastName = '';
        if (isset($data['BillingAddressLastName'])) {
            $BillingAddressLastName = $data['BillingAddressLastName'];
        }

        $BillingAddressPostalCode = '';
        if (isset($data['BillingAddressPostalCode'])) {
            $BillingAddressPostalCode = $data['BillingAddressPostalCode'];
        }

        $BillingAddressStreet = '';
        if (isset($data['BillingAddressStreet'])) {
            $BillingAddressStreet = $data['BillingAddressStreet'];
        }

        $BillingAddressHouseNumber = '';
        if (isset($data['BillingAddressHouseNumber'])) {
            $BillingAddressHouseNumber = $data['BillingAddressHouseNumber'];
        }

        $BillingAddressHouseNumberAddition = '';
        if (isset($data['BillingAddressHouseNumberAddition'])) {
            $BillingAddressHouseNumberAddition = $data['BillingAddressHouseNumberAddition'];
        }

        $BillingAddressCityName = '';
        if (isset($data['BillingAddressCityName'])) {
            $BillingAddressCityName = $data['BillingAddressCityName'];
        }

        $BillingAddressCountryIso = '';
        if (isset($data['BillingAddressCountryIso'])) {
            $BillingAddressCountryIso = $data['BillingAddressCountryIso'];
        }

        $DeliveryAddressFirstName = '';
        if (isset($data['DeliveryAddressFirstName'])) {
            $DeliveryAddressFirstName = $data['DeliveryAddressFirstName'];
        }

        $DeliveryAddressLastName = '';
        if (isset($data['DeliveryAddressLastName'])) {
            $DeliveryAddressLastName = $data['DeliveryAddressLastName'];
        }

        $DeliveryAddressPostalCode = '';
        if (isset($data['DeliveryAddressPostalCode'])) {
            $DeliveryAddressPostalCode = $data['DeliveryAddressPostalCode'];
        }

        $DeliveryAddressStreet = '';
        if (isset($data['DeliveryAddressStreet'])) {
            $DeliveryAddressStreet = $data['DeliveryAddressStreet'];
        }

        $DeliveryAddressHouseNumber = '';
        if (isset($data['DeliveryAddressHouseNumber'])) {
            $DeliveryAddressHouseNumber = $data['DeliveryAddressHouseNumber'];
        }

        $DeliveryAddressHouseNumberAddition = '';
        if (isset($data['DeliveryAddressHouseNumberAddition'])) {
            $DeliveryAddressHouseNumberAddition = $data['DeliveryAddressHouseNumberAddition'];
        }

        $DeliveryAddressCityName = '';
        if (isset($data['DeliveryAddressCityName'])) {
            $DeliveryAddressCityName = $data['DeliveryAddressCityName'];
        }

        $DeliveryAddressCountryIso = '';
        if (isset($data['DeliveryAddressCountryIso'])) {
            $DeliveryAddressCountryIso = $data['DeliveryAddressCountryIso'];
        }

        /** @var OrderItem[] $items */
        $OrderItems = [];
        if (isset($data['items'])) {
            foreach ($data['items'] as $item) {
                $OrderItems[] = OrderItem::createFromArray($item);
            }
        }

        return new self(
            $ExternalOrderNumber,
            $PreferredShippingDate,
            $Email,
            $PhoneNumber,
            $LanguageId,
            $OrderTypeId,
            $ShippingMethodId,
            $PaymentMethodId,
            $BillingAddressFirstName,
            $BillingAddressLastName,
            $BillingAddressPostalCode,
            $BillingAddressStreet,
            $BillingAddressHouseNumber,
            $BillingAddressHouseNumberAddition,
            $BillingAddressCityName,
            $BillingAddressCountryIso,
            $DeliveryAddressFirstName,
            $DeliveryAddressLastName,
            $DeliveryAddressPostalCode,
            $DeliveryAddressStreet,
            $DeliveryAddressHouseNumber,
            $DeliveryAddressHouseNumberAddition,
            $DeliveryAddressCityName,
            $DeliveryAddressCountryIso,
            $OrderItems,
            $data
        );
    }

    public function getExternalOrderNumber(): string
    {
        return $this->ExternalOrderNumber;
    }

    public function getPreferredShippingDate(): string
    {
        return $this->PreferredShippingDate;
    }

    public function getEmail(): string
    {
        return $this->Email;
    }

    public function getPhoneNumber(): string
    {
        return $this->PhoneNumber;
    }

    public function getLanguageId(): string
    {
        return $this->LanguageId;
    }

    public function getOrderTypeId(): int
    {
        return $this->OrderTypeId;
    }

    public function getShippingMethodId(): int
    {
        return $this->ShippingMethodId;
    }

    public function getPaymentMethodId(): int
    {
        return $this->PaymentMethodId;
    }

    public function getBillingAddressFirstName(): string
    {
        return $this->BillingAddressFirstName;
    }

    public function getBillingAddressLastName(): string
    {
        return $this->BillingAddressLastName;
    }

    public function getBillingAddressPostalCode(): string
    {
        return $this->BillingAddressPostalCode;
    }

    public function getBillingAddressStreet(): string
    {
        return $this->BillingAddressStreet;
    }

    public function getBillingAddressHouseNumber(): string
    {
        return $this->BillingAddressHouseNumber;
    }

    public function getBillingAddressHouseNumberAddition(): string
    {
        return $this->BillingAddressHouseNumberAddition;
    }

    public function getBillingAddressCityName(): string
    {
        return $this->BillingAddressCityName;
    }

    public function getBillingAddressCountryIso(): string
    {
        return $this->BillingAddressCountryIso;
    }

    public function getDeliveryAddressFirstName(): string
    {
        return $this->DeliveryAddressFirstName;
    }

    public function getDeliveryAddressLastName(): string
    {
        return $this->DeliveryAddressLastName;
    }

    public function getDeliveryAddressPostalCode(): string
    {
        return $this->DeliveryAddressPostalCode;
    }

    public function getDeliveryAddressStreet(): string
    {
        return $this->DeliveryAddressStreet;
    }

    public function getDeliveryAddressHouseNumber(): string
    {
        return $this->DeliveryAddressHouseNumber;
    }

    public function getDeliveryAddressHouseNumberAddition(): string
    {
        return $this->DeliveryAddressHouseNumberAddition;
    }

    public function getDeliveryAddressCityName(): string
    {
        return $this->DeliveryAddressCityName;
    }

    public function getDeliveryAddressCountryIso(): string
    {
        return $this->DeliveryAddressCountryIso;
    }

    /**
     * @return OrderItem[]
     */
    public function getItems(): array
    {
        return $this->OrderItems;
    }

    public function isSuccesfulCreated()
    {
        if (isset($this->data['messageCode']) && $this->data['messageCode'] == 'OK') {
            return true;
        }

        return false;
    }

    public function getReturnMessage()
    {
        if (isset($this->data['message'])) {
            return $this->data['message'];
        }

        return '';
    }

    public function getReturnData()
    {
        if (isset($this->data)) {
            return $this->data;
        }

        return '';
    }
}
