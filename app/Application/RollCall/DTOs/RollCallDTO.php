<?php
namespace App\Application\RollCall\DTOs;

class RollCallDTO
{
    public function __construct(
        public int $employee_id,
        public bool $entry,
        public string $type,
        public string $status,
        public ?int $created_by = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['employee_id'],
            $data['entry'],
            $data['type'],
            $data['status'] ?? 'waiting',
            $data['created_by'] ?? null,
        );
    }
}
