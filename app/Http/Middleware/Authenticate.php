<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Helpers\ApiValidation;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        return $request->expectsJson() ? null : null;

    }
}
