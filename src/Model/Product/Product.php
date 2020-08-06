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
     * Product constructor.
     * @param string $Sku
     * @param string $Name
     */
    private function __construct(
        string $Sku,
        string $Name
    ) {
        $this->Sku = $Sku;
        $this->Name = $Name;
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
            $Name
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



}
