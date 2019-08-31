<?php

return [
    'bindings' => [
        'webauth' => \App\Services\Verifiers\WebAuthVerifier::class,
        'captcha' => \App\Services\Verifiers\GoogleRecaptchaVerifier::class
    ]
];