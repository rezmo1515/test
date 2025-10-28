<?php
namespace App\Domain\Position\Entities;

class Position
{
    private ?int $id;
    private ?string $title;
    private ?string $code;
    private ?int $departmentId;
    private ?string $description;

    public function __construct(?int $id, ?string $title, ?string $code, ?int $departmentId, ?string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->code = $code;
        $this->departmentId = $departmentId;
        $this->description = $description;
    }

    public function id(): ?int { return $this->id; }
    public function title(): ?string { return $this->title; }
    public function code(): ?string { return $this->code; }
    public function departmentId(): ?int { return $this->departmentId; }
    public function description(): ?string { return $this->description; }

    public function setTitle(?string $title): void { $this->title = $title; }
    public function setCode(?string $code): void { $this->code = $code; }
    public function setDepartmentId(?int $departmentId): void { $this->departmentId = $departmentId; }
    public function setDescription(?string $description): void { $this->description = $description; }
}
