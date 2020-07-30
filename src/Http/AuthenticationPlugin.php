<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Http;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AuthenticationPlugin implements Plugin
{
    const RETRY_LIMIT = 2;

    /**
     * @var array
     */
    private $accessToken;

    /**
     * @var Authenticator
     */
    private $authenticator;

    /**
     * Store the retry counter for each request.
     *
     * @var array
     */
    private $retryStorage = [];

    public function __construct(Authenticator $authenticator, string $accessToken)
    {
        $this->authenticator = $authenticator;
        $this->accessToken = \json_decode($accessToken, true);
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        if (null === $this->accessToken) {
            return $next($request);
        }

        $chainIdentifier = \spl_object_hash((object) $first);
        $header = \sprintf('%s %s',$this->accessToken['token_type'], $this->accessToken['access_token'] ?? '');

        $request = $request->withHeader('Authorization', $header);

        $promise = $next($request);

        return $promise->then(function (ResponseInterface $response) use ($request, $next, $first, $chainIdentifier) {
            if (!\array_key_exists($chainIdentifier, $this->retryStorage)) {
                $this->retryStorage[$chainIdentifier] = 0;
            }

            if (401 !== $response->getStatusCode() || $this->retryStorage[$chainIdentifier] >= self::RETRY_LIMIT) {
                unset($this->retryStorage[$chainIdentifier]);

                return $response;
            }

            return $response;

//            $accessToken = $this->authenticator->refreshAccessToken($this->accessToken['access_token'], $this->accessToken['refresh_token']);
//            if (null === $accessToken) {
//                return $response;
//            }

            // Save new token
//            $this->accessToken = \json_decode($accessToken, true);

            // Add new token to request
//            $header = \sprintf('Bearer %s', $this->accessToken['access_token']);
//            $request = $request->withHeader('Authorization', $header);

            // Retry
//            ++$this->retryStorage[$chainIdentifier];
//            $promise = $this->handleRequest($request, $next, $first);
//
//            return $promise->wait();
        });

        return $response;
    }

    public function getAccessToken(): string
    {
        return \json_encode($this->accessToken);
    }
}
