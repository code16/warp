<?php

use Remic\Warp\Warp;

if (! function_exists('warp_dump')) {
    
    function warp_dump()
    {
        return Warp::getInstance()->dump();
    }
}
