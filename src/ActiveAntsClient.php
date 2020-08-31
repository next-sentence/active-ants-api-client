<?php

declare(strict_types=1);

namespace LWC\ActiveAnts;

use LWC\ActiveAnts\Http\AuthenticationPlugin;
use LWC\ActiveAnts\Http\Authenticator;
use LWC\ActiveAnts\Http\ClientConfigurator;
use LWC\ActiveAnts\Hydrator\Hydrator;
use LWC\ActiveAnts\Hydrator\ModelHydrator;
use Http\Client\HttpClient;

class ActiveAntsClient
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var Hydrator
     */
    private $hydrator;

    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     * @var ClientConfigurator
     */
    private $clientConfigurator;

    /**
     * @var string|null
     */
    private $clientId;

    /**
     * @var string|null
     */
    private $clientSecret;

    /**
     * @var Authenticator
     */
    private $authenticator;

    /**
     * The constructor accepts already configured HTTP clients.
     * Use the configure method to pass a configuration to the Client and create an HTTP Client.
     */
    public function __construct(
        ClientConfigurator $clientConfigurator,
        Hydrator $hydrator = null,
        RequestBuilder $requestBuilder = null
    ) {
        $this->clientConfigurator = $clientConfigurator;
        $this->hydrator = $hydrator ?: new ModelHydrator();
        $this->requestBuilder = $requestBuilder ?: new RequestBuilder();
        $this->authenticator = new Authenticator($this->requestBuilder, $this->clientConfigurator->createConfiguredClient());
    }

    public static function create(string $endpoint): self
    {
        $clientConfigurator = new ClientConfigurator();
        $clientConfigurator->setEndpoint($endpoint);

        return new self($clientConfigurator);
    }

    /**
     * Autnenticate a user with the API. This will return an access token.
     * Warning, this will remove the current access token.
     */
    public function createNewAccessToken(string $username, string $password): ?string
    {
        $this->clientConfigurator->removePlugin(AuthenticationPlugin::class);

        return $this->authenticator->createAccessToken($username, $password);
    }

    /**
     * @param string $accessToken
     */
    public function authenticate(string $accessToken): void
    {
        $this->clientConfigurator->removePlugin(AuthenticationPlugin::class);
        $this->clientConfigurator->appendPlugin(new AuthenticationPlugin($this->authenticator, $accessToken));
    }

    /**
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->authenticator->getAccessToken();
    }

    public function custom(Hydrator $hydrator = null): Api\Custom
    {
        return new Api\Custom($this->getHttpClient(), $hydrator ?? $this->hydrator, $this->requestBuilder);
    }

    public function order(): Api\Order
    {
        return new Api\Order($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    public function product(): Api\Product
    {
        return new Api\Product($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    public function stock(): Api\Stock
    {
        return new Api\Stock($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    private function getHttpClient(): HttpClient
    {
        return $this->clientConfigurator->createConfiguredClient();
    }
}
