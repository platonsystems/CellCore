<?php

namespace App\Contracts;

use Symfony\Component\Routing\RouteCollection;

interface PluginInterface
{
    /**
     * Run logic when plugin is first installed (Run migrations, create tables)
     */
    public function install(): void;

    /**
     * Run logic when plugin is uninstalled (Drop tables, remove files)
     */
    public function uninstall(): void;

    /**
     * Returns menu items for the sidebar
     * Format: [['label' => 'Inventory', 'route' => 'inventory_index', 'icon' => 'box']]
     */
    public function getMenuItems(): array;

    /**
     * Define routes dynamically if not using attributes/yaml
     */
    public function configureRoutes(RouteCollection $routes): void;
}
