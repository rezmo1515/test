<?php

namespace App\Domain\RollCall\Services;

use App\Application\RollCall\UseCases\{
    CreateGvkhroojUseCase,
    UpdateGvkhroojUseCase,
    DeleteGvkhroojUseCase,
    ShowGvkhroojUseCase,
    ListGvkhroojUseCase
};
use App\Models\RollCall as Model;
use App\Infrastructure\RollCall\Repositories\GvkhroojRepository;
use Illuminate\Support\Facades\DB;
use Throwable;

class RollCallRepositoryInterface
{
    protected GvkhroojRepository $repository;
    protected CreateGvkhroojUseCase $createUseCase;
    protected UpdateGvkhroojUseCase $updateUseCase;
    protected DeleteGvkhroojUseCase $deleteUseCase;
    protected ShowGvkhroojUseCase $showUseCase;
    protected ListGvkhroojUseCase $listUseCase;

    public function __construct(
        GvkhroojRepository $repository,
        CreateGvkhroojUseCase $createUseCase,
        UpdateGvkhroojUseCase $updateUseCase,
        DeleteGvkhroojUseCase $deleteUseCase,
        ShowGvkhroojUseCase $showUseCase,
        ListGvkhroojUseCase $listUseCase
    ) {
        $this->repository = $repository;
        $this->createUseCase = $createUseCase;
        $this->updateUseCase = $updateUseCase;
        $this->deleteUseCase = $deleteUseCase;
        $this->showUseCase = $showUseCase;
        $this->listUseCase = $listUseCase;
    }

    /**
     * Store a new Gvkhrooj record
     */
    public function store(array $data): array
    {
        DB::beginTransaction();
        try {
            $entity = $this->createUseCase->execute($data);

            DB::commit();
            return [
                'gvkhrooj' => $entity,
                'message' => 'Gvkhrooj created successfully.',
                'status' => 201
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update an existing Gvkhrooj record
     */
    public function update(Model $gvkhrooj, array $data): array
    {
        $existing = $this->repository->find($gvkhrooj->id);

        if (!$existing) {
            return [
                'gvkhrooj' => [],
                'message' => 'Record not found.',
                'status' => 404
            ];
        }

        DB::beginTransaction();
        try {
            $entity = $this->updateUseCase->execute($gvkhrooj->id, $data);
            DB::commit();

            return [
                'gvkhrooj' => $entity,
                'message' => 'Gvkhrooj updated successfully.',
                'status' => 200
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete a Gvkhrooj record
     */
    public function delete(Model $gvkhrooj): array
    {
        $deleted = $this->deleteUseCase->execute($gvkhrooj->id);

        if ($deleted) {
            return ['message' => 'Gvkhrooj deleted successfully.', 'status' => 200];
        }

        return ['message' => 'Record not found or could not be deleted.', 'status' => 404];
    }

    /**
     * Show details of a single record
     */
    public function show(int $id): array
    {
        $entity = $this->showUseCase->execute($id);
        if (!$entity) {
            return [
                'gvkhrooj' => [],
                'message' => 'Record not found.',
                'status' => 404
            ];
        }

        return [
            'gvkhrooj' => $entity,
            'message' => 'Record retrieved successfully.',
            'status' => 200
        ];
    }

    /**
     * List records with optional filters
     */
    public function filter(array $filters): array
    {
        $records = $this->listUseCase->execute($filters);
        return [
            'data' => $records,
            'message' => 'Records fetched successfully.',
            'status' => 200
        ];
    }
}
