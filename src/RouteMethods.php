<?php

namespace VictoRD11\LaravelUTM;

use Closure;
use VictoRD11\LaravelUTM\Middleware\ParameterTrackerMiddleware;

/**
 * @mixin \Illuminate\Routing\Router
 */
class RouteMethods
{
    public function laravelUTM(): Closure
    {
        return function () {
            $this->get('utm', fn () => response()->noContent())->name('laravel-utm')
                ->middleware(ParameterTrackerMiddleware::class);
        };
    }
}
