<?php
namespace App\Domain\Position\Services;


use App\Application\Position\DTOs\CreatePositionDTO;
use App\Application\Position\UseCases\CreatePositionUseCase;
use App\Application\Position\UseCases\DeletePositionUseCase;
use App\Application\Position\UseCases\UpdatePositionUseCase;
use App\Application\Position\UseCases\ViewPositionUseCase;

class PositionService
{
    protected CreatePositionUseCase $createPositionUseCase;
    protected UpdatePositionUseCase $updatePositionUseCase;
    protected DeletePositionUseCase $deletePositionUseCase;
    protected ViewPositionUseCase $viewPositionUseCase;

    public function __construct(
        CreatePositionUseCase $createPositionUseCase,
        UpdatePositionUseCase $updatePositionUseCase,
        DeletePositionUseCase $deletePositionUseCase,
        ViewPositionUseCase $viewPositionUseCase
    ) {
        $this->createPositionUseCase = $createPositionUseCase;
        $this->updatePositionUseCase = $updatePositionUseCase;
        $this->deletePositionUseCase = $deletePositionUseCase;
        $this->viewPositionUseCase = $viewPositionUseCase;
    }

    public function create(array $data): array
    {
        $dto = CreatePositionDTO::fromArray($data);
        $position = $this->createPositionUseCase->execute($dto);

        return [
            'id' => $position->id(),
            'title' => $position->title(),
            'code' => $position->code(),
            'department_id' => $position->departmentId(),
            'description' => $position->description(),
            'status' => 'position created successfully.',
            'status_code' => 201,
        ];
    }

    public function update(int $id, array $data): array
    {
        $position = $this->updatePositionUseCase->execute($id, $data);

        return [
            'id' => $position->id(),
            'title' => $position->title(),
            'code' => $position->code(),
            'department_id' => $position->departmentId(),
            'description' => $position->description(),
            'status' => 'Position updated successfully.',
            'status_code' => 200,
        ];
    }

    public function delete(int $id): array
    {
        $isDeleted = $this->deletePositionUseCase->execute($id);

        return [
            'status' => $isDeleted ? 'Position deleted successfully.' : 'Position not found.',
            'status_code' => $isDeleted ? 200 : 404,
        ];
    }

    public function show(array $filters): array
    {
        return $this->viewPositionUseCase->execute($filters);
    }
}
