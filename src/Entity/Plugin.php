<?php

namespace App\Service\Entity;

use App\Service\Repository\PluginRepository;
use Doctrine\ORM\Mapping as ORM;

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
    private ?string $entryPoint = null; // The Lifecycle Class

    // ... Getters and Setters for all above ...

    public function getId(): ?int { return $this->id; }
    // Add standard getters/setters here
}
