<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        $contents = require $this->getProjectDir() . '/config/bundles.php';

        foreach ($contents as $class => $envs) {
            if ($envs[$this->environment] ?? $envs['all'] ?? false) {
                yield new $class();
            }
        }

        // --- DYNAMIC PLUGINS START ---
        $pluginCache = $this->getProjectDir() . '/config/installed_plugins.php';
        if (file_exists($pluginCache)) {
            $plugins = require $pluginCache;
            foreach ($plugins as $class => $envs) {
                // Check if class exists to prevent crash if plugin deleted from FS
                if (class_exists($class)) {
                    yield new $class();
                }
            }
        }
        // --- DYNAMIC PLUGINS END ---
    }
}
