<?php

namespace App\Application\Employee\UseCases;

use App\Domain\Employee\Entities\EmployeeDocument;
use App\Domain\Employee\Repositories\EmployeeDocumentRepositoryInterface;
use DateTimeImmutable;
use Illuminate\Http\UploadedFile;

final class AddEmployeeDocumentUseCase
{
    public function __construct(private EmployeeDocumentRepositoryInterface $repo) {}

    public function execute(int $employeeId, array $data): EmployeeDocument
    {
        $filePath = null;
        /** @var UploadedFile|string|null $file */
        $file = $data['file'] ?? null;
        if ($file instanceof UploadedFile) {
            $filePath = $file->storeAs('employee_docs', $file->getClientOriginalName(), 'local');
        } elseif (is_string($file)) {
            $filePath = $file;
        }

        $entity = new EmployeeDocument(
            id: null,
            employeeId: $employeeId,
            type: $data['type'],
            filePath: $filePath,
            description: $data['description'],
        );
        return $this->repo->add($entity);
    }
}
