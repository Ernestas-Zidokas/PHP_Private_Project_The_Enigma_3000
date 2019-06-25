<?php

namespace App\Abstracts;

abstract class Decryption {

    /** array User data from safe input for decryption */
    protected $user_data;

    /** array Encryption class generated array of indexes and values to reverse text */
    protected $encrypted_data;
    
    protected $message;

    /**
     * Function splices safe input data into one letter arrays
     */
    abstract function Splice(): array;

    /**
     * Function joins spliced one data arrays into text after decryption
     */
    abstract function Join($message): string;

    /**
     * Uses the decryption array to get witch letter is witch by the indexes
     */
    abstract function Decryption();

    abstract function getMessage();
}
