<?php

namespace VictoRD11\LaravelUTM\Tests\Sources;

use Illuminate\Http\Request;
use VictoRD11\LaravelUTM\Tests\TestCase;
use VictoRD11\LaravelUTM\Sources\CrossOriginRequestHeader;

class CrossOriginRequestHeaderTest extends TestCase
{
    /** @test */
    public function it_can_get_a_request_header_if_the_request_was_cross_origin()
    {
        $request = new Request();
        $request->headers->set('Foo', 'bar');
        $request->headers->set('Referer', 'https://cross-origin-domain.com/');

        $this->assertEquals('bar', (new CrossOriginRequestHeader($request))->get('foo'));
    }

    /** @test */
    public function it_cant_get_a_request_header_if_the_request_was_not_cross_origin()
    {
        $request = new Request();
        $request->headers->set('Foo', 'bar');
        $request->headers->set('HOST', 'spatie.be');
        $request->headers->set('Referer', 'https://spatie.be/');

        $this->assertNull((new CrossOriginRequestHeader($request))->get('foo'));
    }
}
