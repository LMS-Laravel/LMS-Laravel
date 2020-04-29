<?php


namespace LMS\Modules\Core\Services\Verification\Contracts;


interface VerificationContract
{
    /**
     * Verifies the challenge over given data
     *
     * @param $data
     */
    public function verify($data): void ;

}
