<?php

declare(strict_types=1);

namespace LWC\ActiveAnts\Http;

use LWC\ActiveAnts\Exception\DomainException;
use LWC\ActiveAnts\RequestBuilder;
use Http\Client\HttpClient;
use Psr\Http\Message\ResponseInterface;
use LWC\ActiveAnts\Exception\Domain as DomainExceptions;

/**
 * @internal
 */
final class Authenticator
{
    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var string|null
     */
    private $accessToken;

    public function __construct(RequestBuilder $requestBuilder, HttpClient $httpClient)
    {
        $this->requestBuilder = $requestBuilder;
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $username
     * @param string $password
     * @return string|null
     * @throws DomainException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function createAccessToken(string $username, string $password): ?string
    {
        $request = $this->requestBuilder->create('POST', '/token', [
            'Content-type' => 'application/x-www-form-urlencoded',
        ], \http_build_query([
            'grant_type' => 'password',
            'username' => $username,
            'password' => $password,
        ]));

        $response = $this->httpClient->sendRequest($request);
        // Use any valid status code here
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        $this->accessToken = $response->getBody()->__toString();

        return $this->accessToken;
    }

//    public function refreshAccessToken(string $accessToken, string $refreshToken): ?string
//    {
//        $request = $this->requestBuilder->create('POST', '/token', [
//            'Authorization' => \sprintf('Bearer %s', $accessToken),
//            'Content-type' => 'application/x-www-form-urlencoded',
//        ], \http_build_query([
//            'refresh_token' => $refreshToken,
//            'grant_type' => 'refresh_token',
//        ]));
//
//
//        $response = $this->httpClient->sendRequest($request);
//        if (200 !== $response->getStatusCode()) {
//            return null;
//        }
//
//        $this->accessToken = $response->getBody()->__toString();
//
//        return $this->accessToken;
//    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * Handle HTTP errors.
     *
     * Call is controlled by the specific API methods.
     *
     * @throws DomainException
     */
    protected function handleErrors(ResponseInterface $response)
    {
        $body = $response->getBody()->__toString();

        switch ($response->getStatusCode()) {
            case 400:
                throw new DomainExceptions\BadCredentialsException($body);
            default:
                throw new DomainExceptions\UnknownErrorException();
        }
    }
}
