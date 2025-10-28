<?php
namespace App\Domain\Department\Entities;

class Department
{
    private ?int $id;
    private ?string $name;
    private ?string $code;
    private ?int $managerId;
    private ?string $description;

    public function __construct(?int $id, ?string $name, ?string $code, ?int $managerId, ?string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->managerId = $managerId;
        $this->description = $description;
    }

    public function id(): ?int { return $this->id; }
    public function name(): ?string { return $this->name; }
    public function code(): ?string { return $this->code; }
    public function managerId(): ?int { return $this->managerId; }
    public function description(): ?string { return $this->description; }

    public function setName(?string $name): void { $this->name = $name; }
    public function setCode(?string $code): void { $this->code = $code; }
    public function setManagerId(?int $managerId): void { $this->managerId = $managerId; }
    public function setDescription(?string $description): void { $this->description = $description; }
}
