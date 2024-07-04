<?php

namespace App\Http\Middleware;

use App\Scopes\AgenceScope;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    public function handle($request, Closure $next)
    {
        /*
        $key_agence = null;
        $userMiddelware = auth()->user();
        if ($userMiddelware) {
            $key_agence = $userMiddelware->agence_id;
        }

        $agence = \App\Agence::where('id', $key_agence)->first();
        if (!$agence)
            return response()->json(['error' => 'Unauthorized Agence !!'], 403);

        AgenceScope::setAgence($agence);
        AgenceScope::setKeyAgence($key_agence);
        */

        //Auth::user()->role_id === 2
        if (true) {
            return $next($request);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
