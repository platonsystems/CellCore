<?php

namespace App\Service\Contracts;

interface MenuProviderInterface {
    /** @return array<string, mixed> Returns menu items, routes, and icons */
    public function getSidebarActions(): array;

    /** @return array<string, mixed> Returns toolbar buttons */
    public function getToolbarActions(): array;
}
