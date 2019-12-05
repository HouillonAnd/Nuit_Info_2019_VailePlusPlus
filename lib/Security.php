<?php


class Security
{
    private static $seed = 'nTuRvPCSx846Cca';

    public static function getSeed() {
        return self::$seed;
    }

    public static function shash($text) {
        $hashed = hash('sha256', $text . self::$seed);
        return $hashed;
    }

    public static function generateRandomHex() {
        // Generate a 32 digits hexadecimal number
        $numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
        $bytes = openssl_random_pseudo_bytes($numbytes);
        $hex   = bin2hex($bytes);
        return $hex;
    }
}