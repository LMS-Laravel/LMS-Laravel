<?php


namespace LMS\Modules\Core\Services\Verification\Verifiers;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use LMS\Modules\Core\Services\Verification\Contracts\VerificationContract;

/**
 * Web Authentication Verifier
 *
 * Class WebAuthVerifier
 * @package App\Services\Verifiers
 */
class WebAuthVerifier implements VerificationContract
{

    use AuthenticatesUsers;

    /**
     * @inheritDoc
     */
    public function verify($data): void
    {

        Validator::make($data, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ])->validate();

    }
}
