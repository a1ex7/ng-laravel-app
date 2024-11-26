<?php

namespace App\Services;

use Illuminate\Support\Str;

class GameService
{
    public function chance(): int
    {
        return random_int(1, 1000);
    }

    public function generateInvite(): string
    {
        return Str::uuid()->toString();
    }

    public function isWin(int $chance): bool
    {
        return $chance % 2 === 0;
    }

    public function amount(int $chance): int|float
    {
        if (!$this->isWin($chance)) {
            return 0;
        }

        return match (true) {
            $chance <= 300 => $chance * 0.1,
            300 < $chance && $chance <= 600 => $chance * 0.3,
            600 < $chance && $chance <= 900 => $chance * 0.5,
            900 < $chance => $chance * 0.7,
        };
    }
}