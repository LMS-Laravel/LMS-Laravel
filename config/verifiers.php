<?php

use LMS\Modules\Core\Services\Verification\Verifiers\{GoogleRecaptchaVerifier, WebAuthVerifier};

return [
    'bindings' => [
        'webauth' => WebAuthVerifier::class,
        'captcha' => GoogleRecaptchaVerifier::class
    ]
];
