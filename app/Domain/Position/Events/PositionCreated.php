<?php
namespace App\Domain\Position\Events;

use App\Domain\Position\Entities\Position;
use Illuminate\Queue\SerializesModels;

class PositionCreated
{
    use SerializesModels;

    public Position $position;

    public function __construct(Position $position)
    {
        $this->position = $position;
    }
}
