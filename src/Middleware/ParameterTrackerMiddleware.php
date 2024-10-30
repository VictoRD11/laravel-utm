<?php

namespace VictoRD11\LaravelUTM\Middleware;

use Closure;
use Illuminate\Http\Request;
use VictoRD11\LaravelUTM\ParameterTracker;

class ParameterTrackerMiddleware
{
    public function __construct(protected ParameterTracker $parameterTracker)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $this->parameterTracker->handle();

        return $next($request);
    }
}
