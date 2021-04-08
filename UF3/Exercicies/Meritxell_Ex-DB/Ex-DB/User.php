<?php
     
      
     class User {
      
         public $id;
         public $username;
         public $password;
         public $role;
      
         public function __construct(
             int $id, string $username, string $password, string $role 
         ) {
             $this->id = $id;
             $this->username = $username;
             $this->password = $password;
             $this->role = $role;
         }
      
     //    public function __get($name) {
     //        return $this->$name;
     //    }
     //
     //    public function __set($name, $value) {
     //        $this->$name = $value;
     //    }
      
         public function getId(): int {
             return $this->id;
         }
      
         public function setId(int $id) {
             $this->id = $id;
         }
      
         public function getUsername(): string {
             return $this->username;
         }
      
         public function setUsername(string $username) {
             $this->username = $username;
         }
      
         public function getPassword(): string {
             return $this->password;
         }
      
         public function setPassword(string $password) {
             $this->password = $password;
         }
      
         public function getRole(): string {
             return $this->role;
         }
      
         public function setRole(string $role) {
             $this->role = $role;
         }
      
         public function __toString() {
             return "User{[id=$this->id][username=$this->username][password=$this->password][role=$this->role]}";
         }
      
     }
 
 