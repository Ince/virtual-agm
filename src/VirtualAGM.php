<?php

namespace Ince\VAGM;

use Illuminate\Support\Facades\Facade;

class VirtualAGM extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Ince\VAGM\VagmApi::class;
    }
}
