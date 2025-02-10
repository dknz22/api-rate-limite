<?php

namespace App\Http\Middleware;

use App\Models\RateLimitLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRateLimitExceed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response->getStatusCode() === 429) {
            $ip = $request->ip();
            $endpoint = $request->path();

            $log = RateLimitLog::where('ip_address', $ip)
                ->where('endpoint', $endpoint)
                ->first();

            if ($log) {
                $log->increment('hits');
            } else {
                RateLimitLog::create([
                    'ip_address' => $ip,
                    'endpoint' => $endpoint,
                ]);
            }
        }

        return $response;
    }
}
