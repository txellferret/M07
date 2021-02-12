<?php

/**
 * Reads and writes files csv
 * @author txellfe
 */

class FileCsvPersist {

    private $pathFile;
    private $delimiter;

    public function _construct($pathFile, $delimiter) {
        $this->pathFile = $pathFile;
        $this->delimiter = $delimiter;
    }


    public function readCsv() {
        $users = array();
        if (($handle = fopen("files/users.txt", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $user = new User ($this->$data[0], $this->$data[1], $this->$data[2], $this->$data[3], $this->$data[4]);
                array_push($users, $user);
                
            }
            fclose($handle);
        }
        return $users;

    }


}