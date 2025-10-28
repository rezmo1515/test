<?php

namespace App\Application\RollCall\UseCases;

use App\Models\DeviceRollcall1;

class ShowRollCallDevice1
{
    public function execute(array $filters = []): array
    {
        $query = DeviceRollcall1::query()
            ->with(['employeeDevice1RollCall:id,stid,fname,lname'])
            ->select(['stid', 'station', 'valid', 'kindvkh', 'event_time'])
            ->orderByDesc('event_time');

        if (!empty($filters['fname'])) {
            $query->whereHas('employeeDevice1RollCall', function ($q) use ($filters) {
                $q->where('fname', 'LIKE', "%{$filters['fname']}%");
            });
        }

        if (!empty($filters['lname'])) {
            $query->whereHas('employeeDevice1RollCall', function ($q) use ($filters) {
                $q->where('lname', 'LIKE', "%{$filters['lname']}%");
            });
        }

        if (isset($filters['kindvkh']) && $filters['kindvkh'] !== '') {
            $kindvkh = $filters['kindvkh'];
            if (in_array($kindvkh, ['ورود', '1', 1], true)) {
                $query->where('kindvkh', 1);
            } elseif (in_array($kindvkh, ['خروج', '2', 2], true)) {
                $query->where('kindvkh', 2);
            }
        }

        $rollCalls = $query->get();

        $data = $rollCalls->map(function ($item) {
            return [
                'fname'      => optional($item->employeeDevice1RollCall)->fname,
                'lname'      => optional($item->employeeDevice1RollCall)->lname,
                'station'    => $item->station,
                'valid'      => $item->valid,
                'kindvkh'    => $item->kindvkh == 1 ? 'ورود' : 'خروج',
                'event_time' => $item->event_time,
            ];
        });

        return ['data' => $data];
    }
}
