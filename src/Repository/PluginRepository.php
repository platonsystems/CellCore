<?php

namespace App\Repository;

use App\Contracts\PluginInterface;

class PluginRepository
{
    public function getEnabledPlugins(): array {
        return [];
    }

    public function findOneBy(array $array): ?PluginInterface {
        return null;
    }

    public function findBy(array $array): array
    {
        return [];
    }
}
