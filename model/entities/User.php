<?php
namespace Model\Entities;

use App\Entity;

# Entité représentant un utilisateur
final class User extends Entity{

    # Identifiant unique de l'utilisateur
    private $id;

    # Nom d'utilisateur
    private $username;

    # Date d'inscription
    private $registrationDate;

    # Adresse email de l'utilisateur
    private $email;

    # Mot de passe hashé
    private $password;

    # Indicateur de bannissement (0 ou 1)
    private $banned;

    # Rôle de l'utilisateur (ROLE_USER, ROLE_ADMIN...)
    private $role;

    # Constructeur : hydrate l'objet à partir d'un tableau de données
    public function __construct($data){         
        $this->hydrate($data);        
    }

    # Retourne l'id de l'utilisateur
    public function getId(){
        return $this->id;
    }

    # Définit l'id de l'utilisateur
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    # Retourne le nom d'utilisateur
    public function getUsername(){
        return $this->username;
    }

    # Définit le nom d'utilisateur
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }

    # Retourne la date d'inscription
    public function getRegistrationDate(){
        return $this->registrationDate;
    }

    # Définit la date d'inscription
    public function setRegistrationDate($registrationDate){
        $this->registrationDate = $registrationDate;
        return $this;
    }

    # Retourne l'email de l'utilisateur
    public function getEmail(){
        return $this->email;
    }

    # Définit l'email de l'utilisateur
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    # Retourne le mot de passe hashé
    public function getPassword(){
        return $this->password;
    }

    # Définit le mot de passe hashé
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    # Retourne l'état de bannissement
    public function getBanned(){
        return $this->banned;
    }

    # Définit l'état de bannissement
    public function setBanned($banned){
        $this->banned = $banned;
        return $this;
    }

    # Retourne le rôle de l'utilisateur
    public function getRole(){
        return $this->role;
    }

    # Définit le rôle de l'utilisateur
    public function setRole($role){
        $this->role = $role;
        return $this;
    }

    # Retourne le nom d'utilisateur lorsqu'on utilise l'objet comme une chaîne
    public function __toString() {
        return $this->username;
    }
}
