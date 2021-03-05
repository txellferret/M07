<?php
    require_once "model/User.php";
    /**
     *  DAO for user persistence in file.
     *
     * @author txellfe
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
  
        public function selectAll(): ?array {
            $result = array();
            if (($handle = fopen($this->filename, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, $this->delimiter)) !== FALSE) {

                    $user = new User ($data[0], $data[1], $data[2], $data[3], $data[4]);
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
        public function selectWhere(int $key, string $value): ?array {
            $result = array();
            $lines = file($this->filename); //each elem is a line
            for ($i=0; $i < count($lines); $i++) { 
                $line = explode(";", $lines[$i]); //line is an array of elements of the line
                if ($line[$key] == $value) {
                    $user = new User ($line[0], $line[1], $line[2], $line[3], $line[4]);
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
            if ($u->getRole() == "admin" || $u->getRole() =="registered"){
                $fp = fopen($this->filename, 'a');
                //convert obj to array
                $attributes = array($u->getUsername(), $u->getPassword(), $u->getAge(), $u->getRole(), $u->isActive());
                
                if (fputcsv($fp, $attributes, ";")) {
                    $result = true;
                }
                
                fclose($fp);

            }
            
            return $result;
        }
    

    

    

}