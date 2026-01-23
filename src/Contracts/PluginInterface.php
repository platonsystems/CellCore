<?php

namespace App\Contracts;

use App\Entity\Plugin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.plugin')]
#[AutoconfigureTag('controller.service_arguments')]
interface PluginInterface
{
    /**
     * The public visible names of the current plugin
     * @return string
     */
    public static function getName(): string;

    /**
     * The build version number of the current plugin
     * @return string
     */
    public static function getVersion(): string;

    /**
     * The plugin author's name and contacts (email, GitHub username)
     * @return string
     */
    public static function getAuthor(): string;

    /**
     * The formatted plugin description
     * @return string
     */
    public static function getDescription(): string;

    /**
     * Installs plugin and all its dependencies and apply migrations
     * @return void
     */
    public function install(): void;

    /**
     * Uninstall the plugins, dependencies, rollback migrations
     * and seed database
     * @return void
     */
    public function uninstall(): void;

    /**
     * Activate the plugin
     * @return void
     */
    public function enable(): void;

    /**
     * Disable the plugin
     * @return void
     */
    public function disable(): void;

    /**
     * Update the plugin to the newest version
     * @return void
     */
    public function upgrade(): void;

    /**
     * Manages the current plugin {set parameters, etc}
     * @param Request $request
     * @param Plugin $plugin
     * @return Response|null
     */
    public function manage(Request $request, Plugin $plugin): ?Response;

    /**
     * Method called by the plugin core system to load
     * this plugin
     * @return void
     */
    public function boot(): void;
}
