<?php

namespace WebLinks\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface {
    
    /**
    * User id.
    *
    * @var integer
    */
    private $id;
    
    /**
    * User name.
    *
    * @var string
    */
    private $username;
    
    /**
    * User password.
    *
    * @var string
    */
    private $password;
    
    /**
    * Salt that was originally used to encode the password.
    *
    * @var string
    */
    private $salt;
    
    /**
    * User role.
    * Values : ROLE_USER or ROLE_ADMIN
    *
    * @var string
    */
    private $role;


    public function getId() {
        return $this->id;
    }   
    public function setId($id) {
        $this->id = $id;
    }

    public function getUserName() {
        return $this->username;
    }   
    public function setUserName($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }   
    public function setPassword($password) {
        $this->password = $password;
    }

    public function getSalt() {
        return $this->salt;
    }   
    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function getRole() {
        return $this->role;
    }   
    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
}