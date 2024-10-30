<?php

namespace VictoRD11\LaravelUTM\Tests\Sources;

use Illuminate\Http\Request;
use VictoRD11\LaravelUTM\Tests\TestCase;
use VictoRD11\LaravelUTM\Sources\RequestHeader;

class RequestHeaderTest extends TestCase
{
    /** @test */
    public function it_can_get_a_request_header()
    {
        $request = new Request();
        $request->headers->set('Foo', 'bar');

        $this->assertEquals('bar', (new RequestHeader($request))->get('foo'));
    }
}
