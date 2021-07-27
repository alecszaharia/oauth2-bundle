<?php

declare(strict_types=1);

namespace Trikoder\Bundle\OAuth2Bundle\Manager\Brizy;

use Trikoder\Bundle\OAuth2Bundle\Manager\ClientFilter;
use Trikoder\Bundle\OAuth2Bundle\Manager\ClientManagerInterface;
use Trikoder\Bundle\OAuth2Bundle\Model\Client;

final class ClientManager implements ClientManagerInterface
{
    private $endpoint;
    private $token;

    public function __construct($endpoint,$token)
    {
        $this->endpoint = $endpoint;
        $this->token = $token;
    }

    /**
     * @var Client[]
     */
    private $clients = [];

    /**
     * {@inheritdoc}
     */
    public function find(string $identifier): ?Client
    {
        return $this->clients[$identifier] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Client $client): void
    {
        throw new \Exception('Brizy does not implement  ClientManagerInterface::save');
    }

    /**
     * {@inheritdoc}
     */
    public function remove(Client $client): void
    {
        throw new \Exception('Brizy does not implement  ClientManagerInterface::remove');
    }

    /**
     * {@inheritdoc}
     */
    public function list(?ClientFilter $clientFilter): array
    {
        if (!$clientFilter || !$clientFilter->hasFilters()) {
            return $this->clients;
        }

        return array_filter($this->clients, static function (Client $client) use ($clientFilter): bool {
            $grantsPassed = self::passesFilter($client->getGrants(), $clientFilter->getGrants());
            $scopesPassed = self::passesFilter($client->getScopes(), $clientFilter->getScopes());
            $redirectUrisPassed = self::passesFilter($client->getRedirectUris(), $clientFilter->getRedirectUris());

            return $grantsPassed && $scopesPassed && $redirectUrisPassed;
        });
    }

    private static function passesFilter(array $clientValues, array $filterValues): bool
    {
        if (empty($filterValues)) {
            return true;
        }

        $clientValues = array_map('strval', $clientValues);
        $filterValues = array_map('strval', $filterValues);

        $valuesPassed = array_intersect($filterValues, $clientValues);

        return \count($valuesPassed) > 0;
    }
}
