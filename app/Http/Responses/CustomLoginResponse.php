<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // Ganti rute redirect sesuai kebutuhan Anda
        return redirect()->route('monitoring');
    }
}
