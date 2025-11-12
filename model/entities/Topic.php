<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Topic extends Entity{

    private $id_topic;
    private $title;
    private $idUser;
    private $idCategory;
    private $creationDate;
    private $closed;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getIdTopic(){
        return $this->id_topic;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setIdTopic($id_topic){
        $this->id_topic = $id_topic;
        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle(){
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getIdUser(){
        return $this->idUser;
    }

    /**
     * Set the value of iduser
     *
     * @return  self
     */ 
    public function setIdUser($idUser){
        $this->idUser = $idUser;
        return $this;
    }

        /**
     * Get the value of idCategory
     */ 
    public function getIdCategory(){
        return $this->idCategory;
    }

    /**
     * Set the value of idCategory
     *
     * @return  self
     */ 
    public function setIdCategory($idCategory){
        $this->idCategory = $idCategory;
        return $this;
    }
    /**
     * Get the value of creationDate
     */ 
    public function getCreationDate(){
        return $this->creationDate;
    }

    /**
     * Set the value of creationDate
     *
     * @return  self
     */ 
    public function setCreationDate($creationDate){
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * Get the value of closed
     */ 
    public function getClosed(){
        return $this->closed;
    }

    /**
     * Set the value of closed
     *
     * @return  self
     */ 
    public function setClosed($closed){
        $this->closed = $closed;
        return $this;
    }

    public function __toString(){
        return $this->title;
    }
}