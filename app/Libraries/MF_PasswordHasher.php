<?php
namespace App\Libraries;

class MF_PasswordHasher {

    /**
     *  constructor
     */
    public function __construct() {
        helper("text");
    }

    /**
     * @param  $password string  password to be hashed
     * @param  $hashAlgorithm string the hash algorithm to use
     * @return false|string returns the hashed password
     */
    public function hashPassword(string $password, string $hashAlgorithm = "sha512"){
        return hash($hashAlgorithm, $password);
    }

    /**
     * @param $password string password string to be hashed
     * @param $hashAlgorithm string the hash algorithm to use
     * @param $random bool set to true if you want an auto generated salt or set to false
     * if you want to pass a salt as parameter (by default it's set to true)
     * @param $salt string set of string used to make the password more secure (by default it's set to an empty string)
     * @return array returns an array which contains the salt used and the hashed password
     */
    public function hashPasswordWithSalt(string $password, string $hashAlgorithm = "sha512", bool $random = true, string $salt = ""): array {
        if ($random) {
            $salt = $this->generateSalt();
        }
        return [$salt, hash($hashAlgorithm, $salt.$password)];
    }

    /**
     * @param $type string the type of characters to generate (basic, alpha, alnum, numeric,
     * nozero, md5, sha1, and crypto)
     * @param $length int the length of the salt (minimum recommended 4)
     * @return string
     */
    public function generateSalt(string $type = "alnum", int $length = 8): string {
        return str_shuffle(random_string($type, $length));
    }
}