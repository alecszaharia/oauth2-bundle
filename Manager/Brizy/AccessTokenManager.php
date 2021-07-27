<?php

declare(strict_types=1);

namespace Trikoder\Bundle\OAuth2Bundle\Manager\Brizy;

use DateTimeImmutable;
use Trikoder\Bundle\OAuth2Bundle\Manager\AccessTokenManagerInterface;
use Trikoder\Bundle\OAuth2Bundle\Model\AccessToken;

final class AccessTokenManager implements AccessTokenManagerInterface
{
    /**
     * @var AccessToken[]
     */
    private $accessTokens = [];

    /**
     * {@inheritdoc}
     */
    public function find(string $identifier): ?AccessToken
    {
        return $this->accessTokens[$identifier] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function save(AccessToken $accessToken): void
    {
        throw new \Exception('Brizy does not implement  AccessTokenManagerInterface::save');
    }

    public function clearExpired(): int
    {
        return 0;
    }

    public function clearRevoked(): int
    {
        return 0;
    }
}
