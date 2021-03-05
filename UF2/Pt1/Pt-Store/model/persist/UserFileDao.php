<?php
    require_once "model/User.php";
    /**
     *  DAO for user persistence in file.
     *
     * @author ProvenSoft
     */
    class UserFileDao {

        private  $filename;
        private  $delimiter;
     
        public function __construct() {
            $this->filename = "files/users.txt";
            $this->delimiter = ";";
    
        }
     
        /**
         * retrieves all users.
         * @return array of users
         */
        //TODO: treat errors and fail conditions (using exceptions, etc.)
        public function selectAll(): ?array {
            $result = array();
            if (($handle = fopen($this->filename, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, $this->delimiter)) !== FALSE) {

                    $user = new User ($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
                    array_push($result, $user);
                    
                }
                fclose($handle);
            } else {
                //TODO
            }
        return $result;

        }
     
        /**
         * retrieves users with given value in given property.
         * @param $key: the inde of property name
         * @param $value: the value to search.
         * @return array of users with given cryteria.
         */
        //TODO: treat errors and fail conditions (using exceptions, etc.)
        public function selectWhere(int $key, string $value): ?array {
            $result = array();
            $lines = file($this->filename); //each elem is a line
            for ($i=0; $i < count($lines); $i++) { 
                $line = explode(";", $lines[$i]); //line is an array of elements of the line
                if ($line[$key] == $value) {
                    $user = new User ($line[0], $line[1], $line[2], $line[3], $line[4], $line[5]);
                    array_push($result, $user);
                }
            }
        
            return $result;

        }
     
        /**
         * inserts a new User
         * @param $user: the user object to insert.
         * @return true if correctly added or false otherwise
         */
        public function insertUser(User $u) {
            $result = false;
            if ($u->getRole() == "admin" || $u->getRole() =="staff"){
                $fp = fopen($this->filename, 'a');
                //convert obj to array
                $attributes = array($this->getNextId(), $u->getUsername(), $u->getPassword(), $u->getRole(), $u->getName(), $u->getSurname());
                
                if (fputcsv($fp, $attributes, ";")) {
                    $result = true;
                }
                
                fclose($fp);

            }
            
            return $result;
        }
    

    public function deleteUser(User $u){

        $done =false;
            //get the user
            $uuser = $this->selectWhere(0, $u->getId());
            if (!empty($u)){
                $attributes = array($u->getId(), $u->getUsername(), $u->getPassword(), $u->getRole(), $u->getName(), $u->getSurname());
                $d = implode(";", $attributes);
                
                $allDoc = file($this->filename);
                //trim last space
                $a = array();
                foreach ($allDoc as $v) {
                    array_push($a, trim($v));
                    
                }
                if (($key = array_search($d, $a)) !== false) {
                    unset($allDoc[$key]);

                    $h = fopen($this->filename, "w");
                    if ($h !==false ) {
                        // Guardar los cambios en el archivo:
                        for ($i=0; $i < count($allDoc); $i++) { 
                            trim($allDoc[$i]);
                            fwrite($h, $allDoc[$i]);
                        }
                        $done = true;
                    }
                    fclose($h);

                }
            }
            
            return $done;
        

    }

    public function editUser(User $user) {
        $done =false;
        $u = $this->selectWhere(0, $user->getId());
        if (!empty($u)){
            $attributes = array($user->getId(), $user->getUsername(), $user->getPassword(), $user->getRole(), $user->getName(), $user->getSurname());

                $allDoc = file($this->filename);
                //trim last space
                $a = array();
                foreach ($allDoc as $v) {
                    array_push($a, trim($v));
                    
                }
                for ($i=0; $i < count($a); $i++) { 
                    $line = explode(";",$a[$i]);
                    if($line[0] == $attributes[0]){
                        //transformem line en un string
                        $strinNewLine = implode(";", $attributes);
                        $allDoc[$i] = $strinNewLine.PHP_EOL;
                    break;
                    }
                }
               
                $h = fopen($this->filename, "w");
                    if ($h !==false ) {
                        // Guardar los cambios en el archivo:
                        for ($i=0; $i < count($allDoc); $i++) { 
                            trim($allDoc[$i]);
                            fwrite($h, $allDoc[$i]);
                        }
                        $done = true;
                    }
                    fclose($h);
                $done = true;
            
            
            }
            return $done;
    }
/*
* Get next Id for the future user
 * @return the next id or 0 if an error ocurred
 */
function getNextId () : int{
    $id = 0;
    if ($lines = file($this->filename)){
        $lastLine = explode(";", $lines[count($lines)-1]);
        $id = $lastLine[0]+1;
    }
    return $id;

}

}
