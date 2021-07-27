<?php

declare(strict_types=1);

namespace Trikoder\Bundle\OAuth2Bundle\Manager\InMemory;

use DateTimeImmutable;
use Trikoder\Bundle\OAuth2Bundle\Manager\AuthorizationCodeManagerInterface;
use Trikoder\Bundle\OAuth2Bundle\Model\AuthorizationCode;

final class AuthorizationCodeManager implements AuthorizationCodeManagerInterface
{
    /**
     * @var AuthorizationCode[]
     */
    private $authorizationCodes = [];

    public function find(string $identifier): ?AuthorizationCode
    {
        return $this->authorizationCodes[$identifier] ?? null;
    }

    public function save(AuthorizationCode $authorizationCode): void
    {
        throw new \Exception('Brizy does not implement  AuthorizationCodeManagerInterface::save');
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
