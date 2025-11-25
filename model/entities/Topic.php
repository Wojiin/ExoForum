<?php
namespace Model\Entities;

use App\Entity;

# Entité représentant un topic du forum
final class Topic extends Entity{

    # Identifiant unique du topic
    private $id;

    # Titre du topic
    private $title;

    # Relation vers l'utilisateur ayant créé le topic
    private $user;

    # Relation vers la catégorie du topic
    private $category;

    # Date de création du topic
    private $creationDate;

    # Indique si le topic est fermé (0 ou 1)
    private $closed;

    # Constructeur : hydrate l'objet avec les données fournies
    public function __construct($data){         
        $this->hydrate($data);        
    }

    # Retourne l'id du topic
    public function getId(){
        return $this->id;
    }

    # Définit l'id du topic
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    # Retourne le titre du topic
    public function getTitle(){
        return $this->title;
    }

    # Définit le titre du topic
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    # Retourne l'utilisateur associé au topic
    public function getUser(){
        return $this->user;
    }

    # Définit l'utilisateur associé au topic
    public function setUser($user){
        $this->user = $user;
        return $this;
    }

    # Retourne la catégorie du topic
    public function getCategory(){
        return $this->category;
    }

    # Définit la catégorie du topic
    public function setCategory($category){
        $this->category = $category;
        return $this;
    }

    # Retourne la date de création du topic
    public function getCreationDate(){
        return $this->creationDate;
    }

    # Définit la date de création du topic
    public function setCreationDate($creationDate){
        $this->creationDate = $creationDate;
        return $this;
    }

    # Retourne l'état de fermeture du topic
    public function getClosed(){
        return $this->closed;
    }

    # Définit l'état de fermeture du topic
    public function setClosed($closed){
        $this->closed = $closed;
        return $this;
    }

    # Retourne l'id de l'utilisateur ou null si non défini
    public function getIdUser(){
        return $this->user ? $this->user->getId() : null;
    }

    # Retourne l'id de la catégorie ou null si non défini
    public function getIdCategory(){
        return $this->category ? $this->category->getId() : null;
    }

    # Retourne le titre du topic lorsque l'objet est traité comme une chaîne
    public function __toString(){
        return $this->title;
    }
}
