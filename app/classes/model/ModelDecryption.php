<?php

namespace App\Model;

class ModelDecryption {

    public $db;
    public $table_name;

    public function __construct(\Core\FileDB $db, $table_name) {
        $this->db = $db;
        $this->table_name = $table_name;
    }

    public function load($id) {
        $data_row = $this->db->getRow($this->table_name, $id);
        if ($data_row) {
            return new \App\Decryption($data_row);
        } else {
            return false;
        }
    }

    public function loadArray($id) {
        $data_row = $this->db->getRow($this->table_name, $id);
        if ($data_row) {
            return $data_row;
        } else {
            return false;
        }
    }

    public function insert($id, \App\Decryption $decryption) {
        if (!$this->db->getRow($this->table_name, $id)) {
            $this->db->setRow($this->table_name, $id, $decryption->getData());
            $this->db->save();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Deletes given row by the ID and saves into the database.
     * @param type string $id
     * @return boolean
     */
    public function delete($id) {
        if ($this->db->getRow($this->table_name, $id)) {
            $this->db->deleteRow($this->table_name, $id);
            $this->db->save();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Loads all the rows from given table as array of objects.
     * @return \App\Item\Gerimas[]
     */
    public function loadAll() {
        $decryption_masyvas = [];
        foreach ($this->db->getRows($this->table_name) as $decryption) {
            $decryption_masyvas[] = new \App\Decryption($decryption);
        }
        return $decryption_masyvas;
    }

    /**
     * Deletes all the rows from the given table, and saves into the database.
     * @return boolean
     */
    public function deleteRows() {
        if ($this->db->deleteRows($this->table_name)) {
            $this->db->save();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Deletes whole given table and saves it into the database.
     * @return boolean
     */
    public function deleteTable() {
        if ($this->db->deleteTable($this->table_name)) {
            $this->db->save();
            return true;
        } else {
            return false;
        }
    }

}
