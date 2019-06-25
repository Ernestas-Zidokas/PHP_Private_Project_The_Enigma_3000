<?php

namespace App;

class Encryption extends Abstracts\Encryption {

    public $generated_array;

    public function __construct($alphabet_array, $data) {
        parent::__construct($alphabet_array, $data);
        $this->generateEncryptionArray();
        $this->Encryption();
    }

    public function Encryption() {
        $encrypted_data = [];

        foreach ($this->Splice() as $user_char) {
            foreach ($this->generated_array as $index => $char) {
                if ($user_char == $index) {
                    $encrypted_data[] = $char;
                }
            }
        }

        return $this->message = $this->Join($encrypted_data);
    }

    public function generateEncryptionArray() {

        $shuffled_array = [];
        $keys_normal = array_keys($this->alphabet_array);
        $keys_shuffled = array_keys($this->alphabet_array);
        shuffle($keys_shuffled);
        $counter = 0;

        foreach ($keys_normal as $key_normal) {
            $counter++;
            $shuffled_array[$key_normal] = $keys_shuffled[$counter - 1];
        }
        
        return $this->generated_array = $shuffled_array;
    }

    public function Join($message): string {
        return join("", $message);
    }

    public function Splice(): array {
        return str_split($this->data);
    }

    public function getData() {
        return $this->generated_array;
    }

    public function getMessage() {
        return $this->message;
    }

}
