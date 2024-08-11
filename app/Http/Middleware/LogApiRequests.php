<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Models\ApiLog;

class LogApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Start time
        $startTime = microtime(true);

        // Proceed with the request
        $response = $next($request);

        // Calculate execution time
        $executionTime = microtime(true) - $startTime;

        $token = $request->bearerToken();

        // Check if the endpoint contains the string "server"
        if (strpos($request->path(), 'server') !== false) {
            $token = 'server';
        }


        // Log the API request
        ApiLog::create([
            'method' => $request->method(),
            'endpoint' => $request->path(),
            'response_code' => $response->getStatusCode(),
            'execution_time' => $executionTime,
            'token' => $token,
        ]);

        return $response;
    }
}
