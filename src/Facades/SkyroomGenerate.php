<?php

namespace Moladoust\Skyroomlaravel\Facades;

use Illuminate\Support\Facades\Facade;

class SkyroomGenerate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'SkyroomGenerate';
    }
}
