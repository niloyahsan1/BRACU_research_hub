<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        switch ($user->role) {
            case 'reviewer':
                return redirect()->route('reviewer.dashboard');
            case 'researcher':
                return redirect()->route('researcher.dashboard');
            case 'admin':
                return redirect()->route('dashboard');
            default:
                return redirect(config('fortify.home'));
        }
    }
}
