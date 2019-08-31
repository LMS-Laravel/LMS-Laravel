<?php


namespace App\Services\Verifiers;


use App\Services\Verification\Contracts\VerificationContract;
use Illuminate\Support\Facades\Validator;


/**
 * Google reCaptcha Verifier
 *
 * Class GoogleRecaptchaVerifier
 * @package App\Services\Verifiers
 */
class GoogleRecaptchaVerifier implements VerificationContract
{

    /**
     * @inheritDoc
     */
    public function verify($data): void
    {
        if (!$this->shouldActivate())
            return;

        Validator::make($data, [
            'g-recaptcha-response' => 'required|captcha'
        ])->validate();

    }

    /**
     * Activator for reCaptcha verifier
     *
     * @return bool
     */
    protected function shouldActivate(): bool
    {
        return boolval(config('captcha.enable', false));
    }
}