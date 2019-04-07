<?php

namespace App\Abstracts;

abstract class Encryption {

    /** @var string User data from safe input */
    protected $data;

    /** @var array Array of letters assigned to a number */
    protected $encryption_array;

    protected function __construct($encryption_array, $data) {
        $this->encryption_array = $encryption_array;
        $this->data = $data;
    }

    /**
     * Function splices safe input data into one letter arrays
     */
    abstract function Splice(): array;

    /**
     * Function joins spliced one data arrays into text after encryption
     */
    abstract function Join(): array;

    /**
     * Takes spliced array value (single letter) and assigns 
     * random rolled number from 0-26 to a assigned letter, and puts them into array with the 
     * rolled number ( for decryption ) and the value for displaying encrypted text
     */
    abstract function Encryption(): array;
}
