<?php


namespace App\Services\Verifiers;


use App\Services\Verification\Contracts\VerificationContract;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

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