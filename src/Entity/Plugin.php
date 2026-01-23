<?php

namespace App\Entity;

use App\Repository\PluginRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PluginRepository::class)]
class Plugin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = '';

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $version = '1.0.0.0';

    #[ORM\Column(type: 'string', length: 10000)]
    private string $description = '';

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $enabled = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $installed = false;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $handle = null;

    private bool $upgradable = false;

    #[ORM\Column(type: 'json', nullable: true, options: ['default' => '[]'])]
    private ?array $settings = null;

    // Getters and Setters

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Plugin
     */
    public function setName(?string $name): Plugin
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * @param string|null $version
     * @return Plugin
     */
    public function setVersion(?string $version): Plugin
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Plugin
     */
    public function setDescription(string $description): Plugin
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return Plugin
     */
    public function setEnabled(bool $enabled): Plugin
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function isInstalled(): bool
    {
        return $this->installed;
    }

    /**
     * @param bool $installed
     * @return Plugin
     */
    public function setInstalled(bool $installed): Plugin
    {
        $this->installed = $installed;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHandle(): ?string
    {
        return $this->handle;
    }

    /**
     * @param string|null $handle
     * @return Plugin
     */
    public function setHandle(?string $handle): Plugin
    {
        $this->handle = $handle;
        return $this;
    }

    /**
     * @return bool
     */
    public function isUpgradable(): bool
    {
        return $this->upgradable;
    }

    /**
     * @param bool $upgradable
     * @return Plugin
     */
    public function setUpgradable(bool $upgradable): Plugin
    {
        $this->upgradable = $upgradable;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getSettings(): ?array
    {
        return $this->settings;
    }

    /**
     * @param array|null $settings
     * @return Plugin
     */
    public function setSettings(?array $settings): Plugin
    {
        $this->settings = $settings;
        return $this;
    }
}
