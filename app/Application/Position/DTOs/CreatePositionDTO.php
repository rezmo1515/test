<?php
namespace App\Application\Position\DTOs;

class CreatePositionDTO
{
    public ?string $title;
    public ?string $code;
    public ?int $department_id;
    public ?string $description;

    public static function fromArray(array $data): self
    {
        $dto = new self();
        $dto->title = $data['title'] ?? null;
        $dto->code = $data['code'] ?? null;
        $dto->department_id = $data['department_id'] ?? null;
        $dto->description = $data['description'] ?? null;
        return $dto;
    }
}
