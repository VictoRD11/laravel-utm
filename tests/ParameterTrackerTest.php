<?php

namespace VictoRD11\LaravelUTM\Tests;

use VictoRD11\LaravelUTM\Helpers\Store;
use Illuminate\Http\Request;
use VictoRD11\LaravelUTM\Tests\TestCase;
use VictoRD11\LaravelUTM\ParameterTracker;
use VictoRD11\LaravelUTM\Sources\RequestParameter;

class ParameterTrackerTest extends TestCase
{
    /** @test */
    public function it_can_get_the_tracked_parameters_from_a_request()
    {
        app()->bind(
            Request::class,
            function () {
                return new Request([
                    'irrelevant' => 'value',
                    'utm_source' => 'https://google.com/',
                ]);
            }
        );

        /** @var ParameterTracker */
        $app = app(ParameterTracker::class);
        $app->handle();

        $this->assertEquals(
            [
                'utm_source' => 'https://google.com/',
            ],
            Store::get(config('laravel-utm.first_touch_store_key'))
        );
    }

    /** @test */
    public function it_returns_when_tracking_disabled_request()
    {
        app()->bind(
            Request::class,
            function () {
                return new Request([
                    'irrelevant' => 'value',
                    'utm_source' => 'https://google.com/',
                ]);
            }
        );

        config()->set('laravel-utm.first_touch_store_key', false);
        config()->set('laravel-utm.last_touch_store_key', false);

        /** @var ParameterTracker */
        $app = app(ParameterTracker::class);
        $app->handle();

        $this->assertNull(
            session()->get(config('laravel-utm.first_touch_store_key'))
        );
    }

    /** @test */
    public function it_returns_when_no_params_from_a_request()
    {
        /** @var ParameterTracker */
        $app = app(ParameterTracker::class);
        $app->handle();

        $this->assertNull(
            session()->get(config('laravel-utm.first_touch_store_key'))
        );
    }

    /** @test */
    public function it_can_get_custom_configured_tracked_parameters_from_a_request()
    {
        app()->bind(
            Request::class,
            function () {
                return new Request([
                    'irrelevant' => 'value',
                    'custom_tracked' => 'https://google.com/',
                ]);
            }
        );

        config()->set('laravel-utm.tracked_parameters', [
            [
                'key' => 'custom_tracked',
                'source' => RequestParameter::class,
            ],
        ]);

        /** @var ParameterTracker */
        $app = app(ParameterTracker::class);
        $app->handle();

        $this->assertEquals(
            [
                'custom_tracked' => 'https://google.com/',
            ],
            Store::get(config('laravel-utm.first_touch_store_key'))
        );
    }

    /** @test */
    public function it_can_track_the_referer_header()
    {
        app()->bind(
            Request::class,
            function () {
                $request = new Request();
                $request->headers->add(['Referer' => 'spatie.be']);

                return $request;
            }
        );

        /** @var ParameterTracker */
        $app = app(ParameterTracker::class);
        $app->handle();

        $this->assertEquals(
            [
                'referer' => 'spatie.be',
            ],
            Store::get(config('laravel-utm.first_touch_store_key'))
        );
    }
}
