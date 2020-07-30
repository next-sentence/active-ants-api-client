<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Model\Order;

use LWC\ActiveAnts\Model\CreatableFromArray;

final class Order implements CreatableFromArray
{
    /**
     * @var string
     */
    private $externalOrderNumber;

    /**
     * @var string
     */
    private $currencyCode;

    /**
     * @var string
     */
    private $localeCode;

    /**
     * @var string
     */
    private $checkoutState;

    /**
     * @var OrderItem[]
     */
    private $items;

    /**
     * Order constructor.
     * @param string $externalOrderNumber
     * @param string $currencyCode
     * @param string $localeCode
     * @param string $checkoutState
     * @param array $items
     */
    private function __construct(
        string $externalOrderNumber,
        string $currencyCode,
        string $localeCode,
        string $checkoutState,
        array $items
    ) {
        $this->externalOrderNumber = $externalOrderNumber;
        $this->currencyCode = $currencyCode;
        $this->localeCode = $localeCode;
        $this->checkoutState = $checkoutState;
        $this->items = $items;
    }

    /**
     * @return Order
     */
    public static function createFromArray(array $data): self
    {
        $externalOrderNumber = '';
        if (isset($data['externalOrderNumber'])) {
            $externalOrderNumber = $data['externalOrderNumber'];
        }

        $currencyCode = '';
        if (isset($data['currencyCode'])) {
            $currencyCode = $data['currencyCode'];
        }

        $localeCode = '';
        if (isset($data['localeCode'])) {
            $localeCode = $data['localeCode'];
        }

        $checkoutState = '';
        if (isset($data['checkoutState'])) {
            $checkoutState = $data['checkoutState'];
        }
        /** @var OrderItem[] $items */
        $items = [];
        if (isset($data['items'])) {
            foreach ($data['items'] as $item) {
                $items[] = OrderItem::createFromArray($item);
            }
        }

        return new self($externalOrderNumber, $currencyCode, $localeCode, $checkoutState, $items);
    }

    public function getExternalOrderNumber(): string
    {
        return $this->externalOrderNumber;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function getLocaleCode(): string
    {
        return $this->localeCode;
    }

    public function getCheckoutState(): string
    {
        return $this->checkoutState;
    }

    /**
     * @return OrderItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
