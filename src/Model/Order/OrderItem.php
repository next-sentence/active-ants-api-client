<?php

declare(strict_types=1);

Namespace LWC\ActiveAnts\Model\Order;

use LWC\ActiveAnts\Model\CreatableFromArray;

final class OrderItem implements CreatableFromArray
{
    /**
     * @var string
     */
    private $Sku;

    /**
     * @var int
     */
    private $Quantity;

    /**
     * @var string
     */
    private $Name;

    /**
     * @var float
     */
    private $Price;

    /**
     * @var float
     */
    private $Vat;

    /**
     * OrderItem constructor.
     * @param string $Sku
     * @param string $Name
     * @param int $Quantity
     * @param float $Price
     * @param float $Vat
     */
    private function __construct(
        string $Sku,
        string $Name,
        int $Quantity,
        float $Price,
        float $Vat
    ) {
        $this->Sku = $Sku;
        $this->Quantity = $Quantity;
        $this->Name = $Name;
        $this->Price = $Price;
        $this->Vat = $Vat;
    }

    /**
     * @return OrderItem
     */
    public static function createFromArray(array $data): self
    {
        $Sku = '';
        if (isset($data['Sku'])) {
            $Sku = $data['Sku'];
        }

        $Quantity = -1;
        if (isset($data['Quantity'])) {
            $Quantity = $data['Quantity'];
        }

        $Name = '';
        if (isset($data['Name'])) {
            $Name = $data['Name'];
        }

        $Price = -1;
        if (isset($data['Price'])) {
            $Price = $data['Price'];
        }

        $Vat = -1;
        if (isset($data['Vat'])) {
            $Vat = $data['Vat'];
        }

        return new self($Sku, $Name, $Quantity, $Price, $Vat);
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->Sku;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->Quantity;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->Name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->Price;
    }

    /**
     * @return float
     */
    public function getVat(): float
    {
        return $this->Vat;
    }
}
