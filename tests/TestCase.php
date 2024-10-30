<?php

namespace VictoRD11\LaravelUTM\Tests;

use VictoRD11\LaravelUTM\ServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
        ];
    }
}
