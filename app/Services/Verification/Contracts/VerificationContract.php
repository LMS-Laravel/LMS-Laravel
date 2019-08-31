<?php


namespace App\Services\Verification\Contracts;


use Illuminate\Http\Request;

interface VerificationContract
{
    /**
     * Verifies the challenge over given data
     *
     * @param $data
     */
    public function verify($data): void ;

}