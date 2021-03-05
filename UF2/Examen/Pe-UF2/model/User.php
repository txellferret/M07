<?php

/**
 * ADT for user.
 * 
 * @author txellfe
 */

class User {
    private $username;
    private $password;
    private $age;
    private $role;
    private $active;

    public function __construct(string $username=null, string $password=null, int $age = null,  string $role=null, bool $active=null) {
        
        $this->username = $username;
        $this->password = $password;
        $this->age = $age;
        $this->role = $role;
        $this->active = $active;
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

    public function getAge() {
        return $this->age;
    }

    public function setAge($age): void {
        $this->age = $age;
    }


    public function getRole() {
        return $this->role;
    }

    public function setRole($role): void {
        $this->role = $role;
    }

    public function isActive(){
        return $this->active;
    }
    

    public function setActive($active): void {
        $this->active = $active;
    }



}