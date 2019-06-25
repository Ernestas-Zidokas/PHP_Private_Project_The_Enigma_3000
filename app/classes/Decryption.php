<?php

namespace App;

class Decryption extends Abstracts\Decryption {
    
    public function __construct($encrypted_data, $user_data) {
        $this->encrypted_data = $encrypted_data;
        $this->user_data = $user_data;
        $this->Decryption();
    }
    
    public function Decryption() {
        $decrypted_data = [];
        foreach($this->Splice() as $char){
            foreach($this->encrypted_data as $key => $enc_char){
                if($char == $enc_char){
                    $decrypted_data[] = $key;
                }
            }
        }

        return $this->message = $this->Join($decrypted_data);
    }

    public function Join($message): string {
        return join("", $message);
    }

    public function Splice(): array {
        return str_split($this->user_data);
    }

    public function getMessage() {
        return $this->message;
    }

}

