<?php

/**
 * ADT for user.
 * 
 * @author txellfe
 */

class User {
    
    private $id; //PK
    private $username;
    private $password;
    private $role;
    private $name;
    private $surname;

    //En php nomes podem generar un constructor, no com java que en podem definir molts
    public function __construct(int $id, string $username=null, string $password=null, string $role=null, string $name=null, string $surname=null) {
        //sino no donem valors per defecte no ens deixa instanciar un constructor nomes amb el id
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->name = $name;
        $this->surname = $surname;
    }

    //getters and setters

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }

    

    public function __toString():string {
        
        $result = "User {";
        $result .= sprintf("[id=%s]", $this->id);
        $result .= sprintf("[username=%s]", $this->username);
        $result .= sprintf("[password=%s]", $this->password);
        $result .= sprintf("[role=%s]", $this->role);
        $result .= sprintf("[name=%s]", $this->name);
        $result .= sprintf("[surname=%s]", $this->surname);
        $result .= "}";

        return $result;
    }






}

