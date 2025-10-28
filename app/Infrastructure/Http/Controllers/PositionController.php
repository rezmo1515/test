<?php
namespace App\Infrastructure\Http\Controllers;

use App\Domain\Position\Services\PositionService;
use App\Infrastructure\Http\Requests\Position\ShowPositionRequest;
use App\Infrastructure\Http\Requests\Position\StorePositionRequest;
use App\Infrastructure\Http\Requests\Position\UpdatePositionRequest;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Throwable;

final class PositionController extends ApiController
{
    protected PositionService $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    public function store(StorePositionRequest $request): JsonResponse
    {
        try {
            $this->authorize('create', Position::class);

            return $this->success($this->positionService->create($request->validated()));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to create position right now.');
        }
    }

    public function update(UpdatePositionRequest $request, Position $position): JsonResponse
    {
        try {
            $this->authorize('update', $position);

            return $this->success($this->positionService->update($position->id, $request->validated()));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to update department.');
        }
    }

    public function destroy(Position $position): JsonResponse
    {
        try {
            $this->authorize('delete', $position);

            return $this->success($this->positionService->delete($position->id));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to delete department.', 500);
        }
    }

    public function index(ShowPositionRequest $request): JsonResponse
    {
        $filters = $request->only([
            'title',
            'code',
            'department_id',
            'description'
        ]);

        try {
            $this->authorize('index', Position::class);

            $departments = $this->positionService->show($filters);

            return $this->success($departments);
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to fetch departments.');
        }
    }
}
