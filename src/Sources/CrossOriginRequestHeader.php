<?php

namespace VictoRD11\LaravelUTM\Sources;

use VictoRD11\LaravelUTM\Helpers\Request;

class CrossOriginRequestHeader extends RequestHeader
{
    public function get(string $key): array|string|null
    {
        if (! Request::isCrossOrigin($this->request)) {
            return null;
        }

        return parent::get($key);
    }
}
