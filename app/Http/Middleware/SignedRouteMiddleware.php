<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SignedRouteMiddleware extends Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        if ($this->hasValidSignature($request)) {
            Auth::login($this->getSignedUser($request));

            return $next($request);
        }

        Auth::logout();
        $this->unauthenticated($request, $guards);
    }

    private function hasValidSignature(Request $request): bool
    {
        return $this->hasCorrectSignature($request)
            && $this->signatureHasNotExpired($request);
    }

    private function hasCorrectSignature(Request $request): bool
    {
        return $request->filled('uuid') && Str::isUuid($request->input('uuid'));
    }

    private function signatureHasNotExpired(Request $request): bool
    {
        return User::query()
            ->where('invite', $request->input('uuid'))
            ->where('expired_at', '>', now())
            ->exists();
    }

    private function getSignedUser(Request $request): Authenticatable
    {
        return User::query()
            ->where('invite', $request->input('uuid'))
            ->firstOrFail();
    }
}
