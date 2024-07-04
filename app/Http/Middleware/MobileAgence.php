<?php

namespace App\Http\Middleware;

use App\Scopes\AgenceScope;
use Closure;

class MobileAgence
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $agence = \App\Agence::where('key', $request->header('AppKey'))->first();
        if (!$agence)
            return response()->json(['error' => 'Unauthorized Agence !!'], 403);

        $key_agence = $agence->id;
        AgenceScope::setAgence($agence);
        AgenceScope::setKeyAgence($key_agence);
        return $next($request);
    }
}
