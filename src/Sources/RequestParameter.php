<?php

namespace VictoRD11\LaravelUTM\Sources;

use Illuminate\Http\Request;

class RequestParameter
{
    public function __construct(protected Request $request)
    {
    }

    public function get(string $key): ?string
    {
        return $this->request->get($key);
    }
}
