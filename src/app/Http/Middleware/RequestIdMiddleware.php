<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RequestIdMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil dari header kalau ada, kalau tidak generate
        $rid = $request->header('X-Request-Id') ?: (string) Str::uuid();

        // Simpan supaya bisa dipakai di mana pun
        $request->attributes->set('request_id', $rid);

        // Inject ke logging context (ringan, berguna)
        Log::withContext([
            'request_id' => $rid,
        ]);

        $response = $next($request);

        // Return header biar bisa di-trace dari client
        $response->headers->set('X-Request-Id', $rid);

        return $response;
    }
}
