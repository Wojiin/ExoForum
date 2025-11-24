<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Post extends Entity{

    private $id_post;
    private $user_id;
    private $topic_id;
    private $creationDate;
    private $content;

    // chaque entité aura le même constructeur grâce à la méthode hydrate (issue de App\Entity)
    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id_post
     */ 
    public function getId_post()
    {
        return $this->id_post;
    }

    /**
     * Set the value of id_post
     *
     * @return  self
     */ 
    public function setId_post($id_post)
    {
        $this->id_post = $id_post;

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id(){
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id){
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * Get the value of topic_id
     */ 
    public function getTopic_id(){
        return $this->topic_id;
    }

    /**
     * Set the value of topic_id
     *
     * @return  self
     */ 
    public function setTopic_id($topic_id){
        $this->topic_id = $topic_id;
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
        return $this->content;
    }
}
