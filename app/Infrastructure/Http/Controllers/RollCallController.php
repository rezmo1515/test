<?php

namespace App\Infrastructure\Http\Controllers;

use App\Domain\RollCall\Services\RollCallService;
use App\Infrastructure\Http\Requests\RollCall\RollCallDevice1;
use App\Infrastructure\Http\Requests\RollCall\UpdateRollCallRequest;
use App\Models\DeviceRollcall1;
use App\Models\RollCall;
use App\Infrastructure\Http\Requests\RollCall\RollCallRequest;
use Throwable;

class RollCallController extends ApiController
{
    public function __construct(protected RollCallService $service) {}

    public function showDevice1(RollCallDevice1 $request)
    {
        try {
            $this->authorize('show-device', RollCall::class);
            return $this->success($this->service->showDevice1($request->validated()), 'Device 1 data fetched');
        } catch (Throwable $e) {
            return $this->failure('Failed to fetch device 1 data', 500, ['error' => $e->getMessage()]);
        }
    }

    public function showDevice2()
    {
        $this->authorize('show-device', RollCall::class);
        return $this->success($this->service->showDevice2(), 'Device 2');
    }

    public function showDevice3()
    {
        $this->authorize('show-device', RollCall::class);
        return $this->success($this->service->showDevice3(), 'Device 3');
    }

    public function createEntry(RollCallRequest $request)
    {
        try {
            $this->authorize('create', RollCall::class);
            return $this->created($this->service->createEntry($request->validated()));
        } catch (Throwable $e) {
            return $this->failure('Failed to create entry', 500, ['error' => $e->getMessage()]);
        }
    }

    public function updateEntry(UpdateRollCallRequest $request, RollCall $rollCall)
    {
        try {
            $this->authorize('update', $rollCall);
            return $this->success($this->service->updateEntry($rollCall, $request->validated()));
        } catch (Throwable $e) {
            return $this->failure('Failed to update entry', 500, ['error' => $e->getMessage()]);
        }
    }

    public function deleteEntry(RollCall $rollCall)
    {
        try {
            $this->authorize('delete', $rollCall);
            return $this->success($this->service->deleteEntry($rollCall));
        } catch (Throwable $e) {
            return $this->failure('Failed to delete entry', 500, ['error' => $e->getMessage()]);
        }
    }

    public function showEntries()
    {
        try {
            $this->authorize('index', RollCall::class);
            return $this->success($this->service->showEntries([]));
        } catch (Throwable $e) {
            return $this->failure('Failed to fetch entries', 500, ['error' => $e->getMessage()]);
        }
    }
}
