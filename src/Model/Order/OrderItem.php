<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Model\Order;

use LWC\ActiveAnts\Model\CreatableFromArray;

final class OrderItem implements CreatableFromArray
{
    /**
     * @var string
     */
    private $sku;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var float
     */
    private $VAT;

    /**
     * @var string|null
     */
    private $extra6;

    /**
     * @var string|null
     */
    private $extra7;

    /**
     * OrderItem constructor.
     * @param string $sku
     * @param string $name
     * @param int $quantity
     * @param float $price
     * @param float $VAT
     * @param string|null $extra6
     * @param string|null $extra7
     */
    private function __construct(
        string $sku,
        string $name,
        int $quantity,
        float $price,
        float $VAT,
        ?string $extra6 = null,
        ?string $extra7 = null
    ) {
        $this->sku = $sku;
        $this->quantity = $quantity;
        $this->name = $name;
        $this->price = $price;
        $this->VAT = $VAT;
        $this->extra6 = $extra6;
        $this->extra7 = $extra7;
    }

    /**
     * @return OrderItem
     */
    public static function createFromArray(array $data): self
    {
        $sku = '';
        if (isset($data['sku'])) {
            $sku = $data['sku'];
        }

        $quantity = -1;
        if (isset($data['quantity'])) {
            $quantity = $data['quantity'];
        }

        $name = '';
        if (isset($data['name'])) {
            $name = $data['name'];
        }

        $price = -1;
        if (isset($data['price'])) {
            $price = $data['price'];
        }

        $VAT = -1;
        if (isset($data['VAT'])) {
            $VAT = $data['VAt'];
        }

        return new self($sku, $name, $quantity, $price, $VAT);
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getVAT(): float
    {
        return $this->VAT;
    }

    /**
     * @return string|null
     */
    public function getExtra6(): ?string
    {
        return $this->extra6;
    }

    /**
     * @return string|null
     */
    public function getExtra7(): ?string
    {
        return $this->extra7;
    }
}
