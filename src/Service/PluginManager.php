<?php

namespace App\Service;

use App\Entity\Plugin;
use App\Contracts\PluginInterface;
use App\Repository\PluginRepository;

use Doctrine\ORM\EntityManagerInterface;

use Psr\Log\LoggerInterface;
use Psr\Container\ContainerInterface;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;
// use Symfony\Component\Routing\RouteCollection;

class PluginManager
{
    private string $appsDir;
    private string $pluginCacheFile;

    public function __construct(
        private readonly PluginRepository                                       $pluginRepository,
        private EntityManagerInterface                                          $entityManager,
        private LoggerInterface                                                 $logger,
        #[Autowire('%kernel.project_dir%/apps')] string                         $appsDir,
        #[Autowire('%kernel.project_dir%/config/installed_plugins.php')] string $pluginCacheFile,
        #[AutowireLocator('app.plugin_handler')] private ContainerInterface     $locator
    ) {
        $this->appsDir = $appsDir;
        $this->pluginCacheFile = $pluginCacheFile;
        // Send event to the logg
        $this->logger->debug("Loaded plugin cache file: {$pluginCacheFile}");
    }

    /**
     * Scans the file system and syncs with Database
     */
    public function refreshPlugins(): array {
        // 1. Find all manifest.json files
        $manifests = $this->scanDirectory($this->appsDir);

        $fsPlugins = [];

        foreach ($manifests as $path) {
            $data = json_decode(file_get_contents($path), true);
            if (!$data) continue;

            $pluginId = $data['id'];
            $fsPlugins[] = $pluginId;

            // Sync with DB
            $plugin = $this->pluginRepository->findOneBy(['pluginId' => $pluginId]);
            if (!$plugin) {
                $plugin = new Plugin();
                $plugin->setPluginId($pluginId);
            }

            // Update Metadata from Manifest
            $plugin->setName($data['name'] ?? 'Unknown');
            $plugin->setGroupName($data['group'] ?? 'default');
            $plugin->setVersion($data['version'] ?? '1.0.0');
            $plugin->setDescription($data['description'] ?? '');
            $plugin->setIcon($data['icon'] ?? null);
            $plugin->setEntryPoint($data['entry_point'] ?? null); // The Bundle Class
            $plugin->setPermissions($data['permissions'] ?? []);

            $this->entityManager->persist($plugin);
        }

        $this->entityManager->flush();

        return $fsPlugins;
    }

    /**
     * Enables the plugin and registers the bundle in the config cache
     */
    public function enable(Plugin $plugin): void {
        $plugin->setEnabled(true);
        $this->entityManager->flush();
        $this->dumpPluginCache();
    }

    /**
     * Disables the plugin and removes it from config cache
     */
    public function disable(Plugin $plugin): void {
        $plugin->setEnabled(false);
        $this->entityManager->flush();
        $this->dumpPluginCache();
    }

    public function install(Plugin $plugin): void {
        // Execute the 'install' logic defined in the lifecycle class
        $handler = $this->getLifecycleHandler($plugin);
        $handler?->install();

        $plugin->setInstalled(true);
        $this->entityManager->flush();
    }

    public function uninstall(Plugin $plugin): void {
        // Execute logic
        $handler = $this->getLifecycleHandler($plugin);
        $handler?->uninstall();

        // Disable and remove
        $this->disable($plugin);
        $plugin->setInstalled(false);
        $this->entityManager->flush();
    }

    /**
     * Recursively find manifest.json files
     */
    private function scanDirectory(string $dir): array {
        $results = [];
        $files   = glob($dir . '/*');
        foreach ($files as $file) {
            if (is_dir($file)) {
                $results = array_merge($results, $this->scanDirectory($file));
            }
            elseif (basename($file) === 'manifest.json') {
                $results[] = $file;
            }
        }
        return $results;
    }

    /**
     * Rebuilds the PHP file that Kernel.php includes
     */
    private function dumpPluginCache(): void {
        $plugins = $this->pluginRepository->findBy(['enabled' => true]);
        $bundles = [];

        foreach ($plugins as $plugin) {
            // We need the Namespace\Class of the Bundle
            // e.g. Platon\InventoryBundle\InventoryBundle
            if ($plugin->getEntryPoint()) {
                $bundles[] = $plugin->getEntryPoint();
            }
        }

        $content = "<?php\nreturn [\n";
        foreach ($bundles as $class) {
            $content .= "    $class::class => ['all' => true],\n";
        }
        $content .= "];";

        file_put_contents($this->pluginCacheFile, $content);
    }

    /**
     * Gets the Lifecycle Service (not the Bundle class) if defined
     * Note: You need a way to instantiate this. Usually, the Bundle
     * registers this service in the container.
     */
    private function getLifecycleHandler(Plugin $plugin): ?PluginInterface {
        // Implementation depends on how you name your services
        // Example: 'platon_inventory.handler'
        try {
            // Simplified: assuming the entry point *is* the service ID for now
            // or we use a factory.
            return null; // TODO: Implement service lookup
        }
        catch (\Exception $e) {
            $this->logger->error("Could not load handler for " . $plugin->getName());
            return null;
        }
    }

    public function getEnabledPlugins(): array {
        return [];
    }

    public function getPluginInstance(mixed $plugin): array {
        return [];
    }
}
