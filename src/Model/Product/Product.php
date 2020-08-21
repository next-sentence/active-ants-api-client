<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Model\Product;

use LWC\ActiveAnts\Model\CreatableFromArray;

final class Product implements CreatableFromArray
{
    /**
     * @var string
     */
    private $Sku;

    /**
     * @var string
     */
    private $Name;

    /**
     * @var array
     */
    private $data;

    /**
     * Product constructor.
     * @param string $Sku
     * @param string $Name
     * @param array $data
     *
     */
    private function __construct(
        string $Sku,
        string $Name,
        array $data
    ) {
        $this->Sku = $Sku;
        $this->Name = $Name;
        $this->data = $data;
    }

    /**
     * @return Product
     */
    public static function createFromArray(array $data): self
    {
        $Sku = '';
        if (isset($data['Sku'])) {
            $Sku = $data['Sku'];
        }

        $Name = '';
        if (isset($data['Name'])) {
            $Name = $data['Name'];
        }

        return new self(
            $Sku,
            $Name,
            $data
        );
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->Sku;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->Name;
    }

    public function isSuccesfulInserted()
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
}
