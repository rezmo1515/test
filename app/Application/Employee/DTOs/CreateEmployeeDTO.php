<?php

namespace App\Application\Employee\DTOs;

class CreateEmployeeDTO
{
    public function __construct(
        public ?string $firstName,
        public ?string $lastName,
        public ?string $gender,
        public ?string $birthDate,
        public ?string $nationalId,
        public ?string $fatherName,
        public ?string $birthCertificateNumber,
        public ?string $birthPlace,
        public ?string $maritalStatus,
        public int $childrenCount,

        public bool $createPortalAccount,
        public ?string $portalUsername,
        public ?string $portalPassword,
        public $contractPdf,

        public array $contact = [],
        public array $job = [],
        public array $bankAccounts = [],
        public array $documents = [],
    ) {}

    public static function fromArray(array $p): self
    {
        return new self(
            firstName: $p['first_name'] ?? null,
            lastName: $p['last_name'] ?? null,
            gender: $p['gender'] ?? null,
            birthDate: $p['birth_date'] ?? null,
            nationalId: $p['national_id'] ?? null,
            fatherName: $p['father_name'] ?? null,
            birthCertificateNumber: $p['birth_certificate_number'] ?? null,
            birthPlace: $p['birth_place'] ?? null,
            maritalStatus: $p['marital_status'] ?? null,
            childrenCount: (int)($p['children_count'] ?? 0),

            createPortalAccount: (bool)($p['create_portal_account'] ?? false),
            portalUsername: $p['portal_username'] ?? null,
            portalPassword: $p['portal_password'] ?? null,
            contractPdf: $p['contract_pdf'] ?? null,

            contact: $p['contact'] ?? [],
            job: $p['job'] ?? [],
            bankAccounts: $p['bank_accounts'] ?? [],
            documents: $p['documents'] ?? [],
        );
    }
}
