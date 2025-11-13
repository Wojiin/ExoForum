<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Post extends Entity{

    private $id;
    private $title;
    private $idUser;
    private $username;
    private $idTopic;
    private $creationDate;
    private $content;

    // chaque entité aura le même constructeur grâce à la méthode hydrate (issue de App\Entity)
    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of id_user
     */ 
    public function getIdUser(){
        return $this->idUser;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setIdUser($idUser){
        $this->idUser = $idUser;
        return $this;
    }
    /**
     * Get the value of username
     *
     * @return  self
     */
    public function getUsername() {
    return $this->username;
    }
    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username) {
    $this->username = $username;
    return $this;
    }
    /**
     * Get the value of id_topic
     */ 
    public function getIdTopic(){
        return $this->idTopic;
    }

    /**
     * Set the value of id_topic
     *
     * @return  self
     */ 
    public function setIdTopic($idTopic){
        $this->idTopic = $idTopic;
        return $this;
    }
    /**
     * Get the value of creation_date
     */ 
    public function getCreationDate(){
        return $this->creationDate;
    }

    /**
     * Set the value of creation_date
     *
     * @return  self
     */ 
    public function setCreationDate($creationDate){
        $this->creationDate = $creationDate;
        return $this;
    }
    /**
     * Get the value of content
     */ 
    public function getContent(){
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content){
        $this->content = $content;
        return $this;
    }

    public function __toString(){
        return $this->title;
    }
}