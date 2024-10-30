<?php

namespace VictoRD11\LaravelUTM\Sources;

use VictoRD11\LaravelUTM\Helpers\Request;

class CrossOriginRequestParameter extends RequestParameter
{
    public function get(string $key): ?string
    {
        if (! Request::isCrossOrigin($this->request)) {
            return null;
        }

        return parent::get($key);
    }
}
