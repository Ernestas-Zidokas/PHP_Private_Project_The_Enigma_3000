<?php

namespace App;

class Encryption extends Abstracts\Encryption {

    public function __construct($encryption_array, $data) {
        parent::__construct($encryption_array, $data);
        $this->Encryption();
    }

    public function Encryption() {
        $encrypted_data = [];
        $counter = 0;
        foreach ($this->Splice() as $char) {
            $encrypted_data[$char . '-' . $counter++] = $this->encryption_array[rand(0, 25)];
        }

        return $this->data = $encrypted_data;
    }

    public function Join(): string {
        return join("", $this->data);
    }

    public function Splice(): array {
        return str_split($this->data);
    }

    public function getData() {
        return $this->data;
    }

}
