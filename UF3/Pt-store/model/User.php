<?php
namespace proven\store\model;

class User {
    
    private int $id;
    private string $username;
    private string $password;
    private string $firstname;
    private string $lastname;
    private string $role;

    public function __construct(int $id, string $username = "", string $password = "", 
    string $firstname = "", string $lastname = "", string $role = "" ) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->role = $role;
    }

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

    public function setPassword(string $password): void {
        $this->password = $password;
    }
    function getFirstname(): string {
        return $this->firstname;
    }

    function getLastname(): string {
        return $this->lastname;
    }

    function setFirstname(string $firstname): void {
        $this->firstname = $firstname;
    }

    function setLastname(string $lastname): void {
        $this->lastname = $lastname;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }

    public function __toString() {
        return sprintf("User{[id=%d][username=%s][password=%s][firstname=%s][lastname=%s][role=%s]}",
            $this->id, $this->username, $this->password,
            $this->firstname, $this->lastname, $this->role);
    }

}