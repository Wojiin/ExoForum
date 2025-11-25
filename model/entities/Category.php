<?php
namespace Model\Entities;

use App\Entity;

# Entité représentant une catégorie
final class Category extends Entity{

    # Identifiant unique de la catégorie
    private $id;

    # Nom de la catégorie
    private $name;

    # Constructeur : hydrate l’objet avec les données reçues
    public function __construct($data){         
        $this->hydrate($data);        
    }

    # Retourne l'id de la catégorie
    public function getId(){
        return $this->id;
    }

    # Définit l'id de la catégorie
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    # Retourne le nom de la catégorie
    public function getName(){
        return $this->name;
    }

    # Définit le nom de la catégorie
    public function setName($name){
        $this->name = $name;
        return $this;
    }

    # Retourne le nom de la catégorie lorsqu'on traite l'objet comme une chaîne
    public function __toString(){
        return $this->name;
    }
}
