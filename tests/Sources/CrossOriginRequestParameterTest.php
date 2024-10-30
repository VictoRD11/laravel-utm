<?php

namespace VictoRD11\LaravelUTM\Tests\Sources;

use Illuminate\Http\Request;
use VictoRD11\LaravelUTM\Tests\TestCase;
use VictoRD11\LaravelUTM\Sources\CrossOriginRequestParameter;

class CrossOriginRequestParameterTest extends TestCase
{
    /** @test */
    public function it_can_get_a_request_parameter_if_the_request_was_cross_origin()
    {
        $request = new Request([
            'foo' => 'bar',
        ]);
        $request->headers->set('Referer', 'https://cross-origin-domain.com/');

        $this->assertEquals('bar', (new CrossOriginRequestParameter($request))->get('foo'));
    }

    /** @test */
    public function it_cant_get_a_request_parameter_if_the_request_was_not_cross_origin()
    {
        $request = new Request([
            'foo' => 'bar',
        ]);
        $request->headers->set('HOST', 'spatie.be');
        $request->headers->set('Referer', 'https://spatie.be/');

        $this->assertNull((new CrossOriginRequestParameter($request))->get('foo'));
    }
}
