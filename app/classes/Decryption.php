<?php

namespace App;

class Decryption extends Abstracts\Decryption {
    
    public function __construct($encrypted_data, $user_data) {
        $this->encrypted_data = $encrypted_data;
        $this->user_data = $user_data;
        var_dump($this->encrypted_data);
        
    }
    
    public function Decryption(): array {
        
    }

    public function Join(): array {
        
    }

    public function Splice(): array {
        
    }

}

