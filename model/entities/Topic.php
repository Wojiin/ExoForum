<?php
namespace Model\Entities;

use App\Entity;

final class Topic extends Entity{

    private $id_topic;
    private $title;
    private $user_id;
    private $category_id;
    private $creationDate;
    private $closed;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    public function getId_topic(){
        return $this->id_topic;
    }

    public function setId_topic($id_topic){
        $this->id_topic = $id_topic;
        return $this;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function getUser_id(){
        return $this->user_id;
    }

    public function setUser_id($user_id){
        $this->user_id = $user_id;
        return $this;
    }

    public function getCategory_id(){
        return $this->category_id;
    }

    public function setCategory_id($category_id){
        $this->category_id = $category_id;
        return $this;
    }

    public function getCreationDate(){
        return $this->creationDate;
    }

    public function setCreationDate($creationDate){
        $this->creationDate = $creationDate;
        return $this;
    }

    public function getClosed(){
        return $this->closed;
    }

    public function setClosed($closed){
        $this->closed = $closed;
        return $this;
    }

    public function __toString(){
        return $this->title;
    }
}
