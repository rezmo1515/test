<?php

namespace App\Domain\RollCall\Entities;

class RollCall
{
    public function __construct(
        public int $employee_id,
        public bool $entry,
        public string $type,
        public string $status,
        public ?int $created_by = null,
    ) {}
}
