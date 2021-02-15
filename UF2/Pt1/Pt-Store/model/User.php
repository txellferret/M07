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
    public function __construct(int $id=null, string $username=null, string $password=null, string $role=null, string $name=null, string $surname=null) {
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

    public function getRole() {
        return $this->role;
    }

    public function setRole($role): void {
        $this->role = $role;
    }
 
    public function getName() {
        return $this->name;
    }

    public function setName( $name): void {
        $this->name = $name;
    }
 
    public function getSurname() {
        return $this->surname;
    }
    
    public function setSurname( $surname): void {
        $this->surname = $surname;
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

