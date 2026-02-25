<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PluginRepository;

#[ORM\Entity(repositoryClass: PluginRepository::class)]
class Plugin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $pluginId = null; // Matches manifest "id"

    #[ORM\Column(length: 255)]
    private ?string $name = null; // Display Name

    #[ORM\Column(length: 255)]
    private ?string $handle = null; // The Namespace\Class

    #[ORM\Column(length: 50)]
    private ?string $groupName = 'default';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $icon = null;

    #[ORM\Column(length: 50)]
    private ?string $version = '1.0.0';

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'json')]
    private array $permissions = [];

    #[ORM\Column]
    private bool $enabled = false;

    #[ORM\Column]
    private bool $installed = false;

    #[ORM\Column(nullable: true)]
    private ?string $entryPoint = null;

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Plugin
     */
    public function setId(?int $id): Plugin {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPluginId(): ?string {
        return $this->pluginId;
    }

    /**
     * @param string|null $pluginId
     * @return Plugin
     */
    public function setPluginId(?string $pluginId): Plugin {
        $this->pluginId = $pluginId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Plugin
     */
    public function setName(?string $name): Plugin {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHandle(): ?string {
        return $this->handle;
    }

    /**
     * @param string|null $handle
     * @return Plugin
     */
    public function setHandle(?string $handle): Plugin {
        $this->handle = $handle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroupName(): ?string {
        return $this->groupName;
    }

    /**
     * @param string|null $groupName
     * @return Plugin
     */
    public function setGroupName(?string $groupName): Plugin {
        $this->groupName = $groupName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     * @return Plugin
     */
    public function setIcon(?string $icon): Plugin {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVersion(): ?string {
        return $this->version;
    }

    /**
     * @param string|null $version
     * @return Plugin
     */
    public function setVersion(?string $version): Plugin {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Plugin
     */
    public function setDescription(?string $description): Plugin {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array
     */
    public function getPermissions(): array {
        return $this->permissions;
    }

    /**
     * @param array $permissions
     * @return Plugin
     */
    public function setPermissions(array $permissions): Plugin {
        $this->permissions = $permissions;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return Plugin
     */
    public function setEnabled(bool $enabled): Plugin {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function isInstalled(): bool {
        return $this->installed;
    }

    /**
     * @param bool $installed
     * @return Plugin
     */
    public function setInstalled(bool $installed): Plugin {
        $this->installed = $installed;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntryPoint(): ?string {
        return $this->entryPoint;
    }

    /**
     * @param string|null $entryPoint
     * @return Plugin
     */
    public function setEntryPoint(?string $entryPoint): Plugin {
        $this->entryPoint = $entryPoint;
        return $this;
    }


}
