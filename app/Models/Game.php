<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'lottery',
        'win',
        'amount',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'win' => 'boolean',
        ];
    }

    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $value / 100,
            set: fn(string $value) => round($value * 100),
        );
    }
}
