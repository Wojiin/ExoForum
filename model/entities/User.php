<?php
namespace Model\Entities;

use App\Entity;

final class User extends Entity{

    private $id_user;
    private $username;
    private $registrationDate;
    private $email;
    private $password;
    private $banned;
    private $role;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    public function getId_user(){
        return $this->id_user;
    }

    public function setId_user($id_user){
        $this->id_user = $id_user;
        return $this;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        $this->username = $username;
        return $this;
    }

    public function getRegistrationDate(){
        return $this->registrationDate;
    }

    public function setRegistrationDate($registrationDate){
        $this->registrationDate = $registrationDate;
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    public function getBanned(){
        return $this->banned;
    }

    public function setBanned($banned){
        $this->banned = $banned;
        return $this;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        $this->role = $role;
        return $this;
    }

    public function __toString() {
        return $this->username;
    }
}
