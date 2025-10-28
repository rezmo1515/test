<?php
namespace App\Application\Department\DTOs;

class DepartmentDTO
{
    public ?string $name;
    public ?string $code;
    public ?int $managerId;
    public ?string $description;

    public static function fromArray(array $data): self
    {
        $dto = new self();
        $dto->name = $data['name'] ?? null;
        $dto->code = $data['code'] ?? null;
        $dto->managerId = $data['manager_id'] ?? null;
        $dto->description = $data['description'] ?? null;
        return $dto;
    }
}
