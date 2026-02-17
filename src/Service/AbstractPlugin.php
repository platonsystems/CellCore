<?php

namespace App\Service;

use App\Service\Contracts\PluginInterface;
use Symfony\Component\Routing\RouteCollection;

abstract class AbstractPlugin implements PluginInterface
{
    public function install(): void
    {
        // Default: Do nothing
    }

    public function uninstall(): void
    {
        // Default: Do nothing
    }

    public function getMenuItems(): array
    {
        return [];
    }

    public function configureRoutes(RouteCollection $routes): void
    {
        // Default: Do nothing
    }
}
