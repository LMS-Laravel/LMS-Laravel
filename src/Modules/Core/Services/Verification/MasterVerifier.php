<?php



namespace LMS\Modules\Core\Services\Verification;


class MasterVerifier
{
    /**
     * Runner method to invoke the all-in-config/supplied verifiers
     *
     * @param $data - Data to be run through verifier(s)
     * @param array $verifiers - List of verifiers for data verification
     */
    public function verify($data, $verifiers = []): void
    {
        // Circuit bypass for no verifiers
        if ($verifiers == null)
            return;

        // If no verifiers supplied to method,
        // Get verifiers from bindings defined in verifier config
        if (empty($verifiers))
            $verifiers = config('verifiers.bindings', []);

        foreach ($verifiers as $verifier)
            // Verify the data through every verifier
            app($verifier)->verify($data);


    }
}
