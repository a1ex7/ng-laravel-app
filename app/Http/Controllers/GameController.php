<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Services\GameService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GameController extends Controller
{
    public function __construct(private readonly GameService $gameService)
    {
    }

    public function index(Request $request): Response
    {
        $games = $request->user()
            ->games()
            ->latest()
            ->take(3)
            ->get();

        return Inertia::render('Profile/Edit', [
            'games' => GameResource::collection($games)
        ]);
    }

    public function create(Request $request): Response
    {
        $lottery = $this->gameService->chance();
        $isWin = $this->gameService->isWin($lottery);
        $amount = $this->gameService->amount($lottery);

        $game = $request->user()
            ->games()
            ->create([
                'lottery' => $lottery,
                'win' => $isWin,
                'amount' => $amount
            ]);

        return Inertia::render('Profile/Edit', [
            'game' => GameResource::make($game)
        ]);
    }
}
