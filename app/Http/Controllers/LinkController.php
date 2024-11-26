<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    public function __construct(private readonly GameService $gameService)
    {
    }

    public function update(Request $request): RedirectResponse
    {
        $invite = $this->gameService->generateInvite();
        $request->user()->update([
            'invite' => $invite,
        ]);

        return Redirect::route('profile.edit', ['uuid' => (string)$invite])
            ->with('status', 'link-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('register');
    }
}
