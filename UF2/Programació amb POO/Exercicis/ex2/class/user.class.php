<?php

class User {

    //attributes
    private $username;
    private $password;
    private $role;
    private $name;
    private $surname;

    public function __construct(string $username, string $password, string $role, string $name, string $surname) {
		$this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->name = $name;
        $this->surname = $surname;
    }
    

    /**
     * Gets the value of username.
     * @return string
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * Sets the value of username.
     * @param string $username the username
     */
    public function setUsername(string $username) {
        $this->username = $username;
    }

    /**
     * Gets the value of password.
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * Sets the value of password.
     * @param string $password the password
     */
    public function setPassword(string $password) {
        $this->password = $password;
    }

    /**
     * Gets the value of role.
     * @return string
     */
    public function getRole(): string {
        return $this->role;
    }

    /**
     * Sets the value of role.
     * @param string $role the role
     */
    public function setRole(string $role) {
        $this->role = $role;
    }

    /**
     * Gets the value of name.
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Sets the value of name.
     * @param string $name the name
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * Gets the value of surname.
     * @return string
     */
    public function getSurname(): string {
        return $this->surname;
    }

    /**
     * Sets the value of surname.
     * @param string $surname the surname
     */
    public function setSurname(string $surname) {
        $this->surname = $surname;
    }

    /**
     * Converts object to string format.
     * @return string
     */  
    public function __toString() {
        return sprintf("%s{[username:%s][password:%s][role:%s][name:%s][surname:%s]}", get_class($this), 
        $this->username,$this->password, $this->role, $this->name, $this->surname);
    }

}