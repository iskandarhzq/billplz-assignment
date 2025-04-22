<?php

namespace App\Services;

class PasswordGenerator
{
    public static function generate(
        $length = 12,
        $withLower = true,
        $withCapital = true,
        $withNumeric = true,
        $withSymbols = true
    ) {
        $characters = [];
        $password = '';

        if ($withLower) {
            $characters[] = 'abcdefghijklmnopqrstuvwxyz';
        }
        if ($withCapital) {
            $characters[] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($withNumeric) {
            $characters[] = '0123456789';
        }
        if ($withSymbols) {
            $characters[] = '!#$%&()*+@^';
        }

        if (empty($characters)) {
            throw new \Exception('At least one character must be selected.');
        }

        // Preserve one character each
        foreach ($characters as $character) {
            $password .= $character[random_int(0, strlen($character) - 1)];
        }

        $allChars = implode('', $characters);
        $remainingLength = $length - strlen($password);

        for ($i = 0; $i < $remainingLength; $i++) {
            $password .= $allChars[random_int(0, strlen($allChars) - 1)];
        }

        return str_shuffle($password);
    }
}
