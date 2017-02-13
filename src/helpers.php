<?php

use Code16\Warp\Warp;

if (! function_exists('warp_dump')) {
    
    function warp_dump()
    {
        return app(Warp::class)->dump();
    }
}
