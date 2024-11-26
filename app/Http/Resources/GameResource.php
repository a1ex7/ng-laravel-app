<?php

namespace App\Http\Resources;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Game */
class GameResource extends JsonResource
{
    public static $wrap;

    public function toArray(Request $request): array
    {
        return [
            'lottery' => $this->lottery,
            'win' => $this->win,
            'amount' => $this->amount,
        ];
    }
}
