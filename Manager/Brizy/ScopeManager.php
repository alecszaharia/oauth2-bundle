<?php

declare(strict_types=1);

namespace Trikoder\Bundle\OAuth2Bundle\Manager\Brizy;

use Trikoder\Bundle\OAuth2Bundle\Manager\ScopeManagerInterface;
use Trikoder\Bundle\OAuth2Bundle\Model\Scope;

final class ScopeManager implements ScopeManagerInterface
{
    /**
     * @var Scope[]
     */
    private $scopes = [];

    /**
     * {@inheritdoc}
     */
    public function find(string $identifier): ?Scope
    {
        return $this->scopes[$identifier] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Scope $scope): void
    {
        throw new \Exception('Brizy does not implement  ScopeManagerInterface::save');
    }
}
