<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Hydrator;

use Psr\Http\Message\ResponseInterface;

/**
 * Do not hydrate to any object at all.
 */
final class NoopHydrator implements Hydrator
{
    /**
     * @throws \LogicException
     */
    public function hydrate(ResponseInterface $response, ?string $class = null)
    {
        throw new \LogicException('The NoopHydrator should never be called');
    }
}
