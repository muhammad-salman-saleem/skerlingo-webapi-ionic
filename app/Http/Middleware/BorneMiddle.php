<?php

namespace App\Http\Middleware;

use App\Scopes\AgenceScope;
use Closure;
use Illuminate\Support\Facades\Auth;

class BorneMiddle
{
    public function handle($request, Closure $next)
    {
        $key_agence = $request->get('alias');
        if (!$key_agence)
            return response()->json(['error' => 'Unauthorized Agence !!'], 403);

        $agence = \App\Agence::where('alias', $key_agence)->first();
        if (!$agence)
            return response()->json(['error' => 'Unauthorized Agence !!'], 403);

        AgenceScope::setAgence($agence);
        AgenceScope::setKeyAgence($agence->id);


        return $next($request);
        /*
        if (Auth::user()->role_id === 2) {
            return $next($request);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        */
    }
}
