<?php


if(!function_exists('is_active')){
    function is_active($uri) : string
    {
        return request()->is($uri) ? 'active' : 'not';
    }
}
