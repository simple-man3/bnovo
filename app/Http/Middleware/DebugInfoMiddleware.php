<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DebugInfoMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage();

        $response = $next($request);

        $endTime = microtime(true);
        $endMemory = memory_get_usage();

        $executionTime = ($endTime - $startTime) * 1000;
        $memoryUsage = ($endMemory - $startMemory) / 1024;

        $response->headers->set('X-Debug-Time', round($executionTime, 2));
        $response->headers->set('X-Debug-Memory', round($memoryUsage, 2));

        return $response;
    }
}
