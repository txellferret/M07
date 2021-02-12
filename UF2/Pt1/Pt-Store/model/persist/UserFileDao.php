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
         * @return number of objects inserted.
         */
        //TODO: treat errors and fail conditions (using exceptions, etc.)
        public function insert(User $user): int {
            $result = 0;
            $fp = fopen($this->filename, 'a');
            //convert obj to array
            $attributes = get_object_vars($user);
            
            foreach ($attributes as $key => $value) {

                fputcsv($fp, $value);
            }
            

            fclose($fp);




            return $result;
        }
    }

