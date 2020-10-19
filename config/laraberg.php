<?php

use VanOns\Laraberg\Models\Block;
use VanOns\Laraberg\Models\Content;

return [
    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    */

    'use_package_routes' => false,

    'middlewares' => ['web', 'auth'],

    'prefix' => 'laraberg',

    "models" => [
        "block" => Block::class,
        "content" => Content::class,
    ],

];
