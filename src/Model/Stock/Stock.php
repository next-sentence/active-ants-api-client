<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Model\Stock;

use LWC\ActiveAnts\Model\CreatableFromArray;

final class Stock implements CreatableFromArray
{
    /**
     * @var string
     */
    private $messageCode;

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    private $result;

    /**
     * Product constructor.
     * @param string $messageCode
     * @param string $message
     * @param array $result
     *
     */
    private function __construct(
        string $messageCode,
        string $message,
        array $result
    ) {
        $this->messageCode = $messageCode;
        $this->message = $message;
        $this->result = $result;
    }

    /**
     * @param array $data
     * @return Stock
     */
    public static function createFromArray(array $data): self
    {

        return new self(
            $data['messageCode'],
            $data['message'],
            $data['result']
        );
    }

    /**
     * @return string
     */
    public function getMessageCode(): string
    {
        return $this->messageCode;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }

}
