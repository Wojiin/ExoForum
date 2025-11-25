<?php
namespace Model\Entities;

use App\Entity;

# Entité représentant un post de forum
final class Post extends Entity{

    # Identifiant unique du post
    private $id;

    # Relation vers l'utilisateur ayant publié le post
    private $user;

    # Relation vers le topic dans lequel est publié le post
    private $topic;

    # Date de création du post
    private $creationDate;

    # Contenu du post
    private $content;

    # Constructeur : hydrate l'objet avec les données fournies
    public function __construct($data){         
        $this->hydrate($data);        
    }

    # Retourne l'id du post
    public function getId(){
        return $this->id;
    }

    # Définit l'id du post
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    # Retourne l'utilisateur associé au post
    public function getUser(){
        return $this->user;
    }

    # Définit l'utilisateur associé au post
    public function setUser($user){
        $this->user = $user;
        return $this;
    }

    # Retourne le topic associé au post
    public function getTopic(){
        return $this->topic;
    }

    # Définit le topic associé au post
    public function setTopic($topic){
        $this->topic = $topic;
        return $this;
    }

    # Retourne la date de création du post
    public function getCreationDate(){
        return $this->creationDate;
    }

    # Définit la date de création du post
    public function setCreationDate($creationDate){
        $this->creationDate = $creationDate;
        return $this;
    }

    # Retourne le contenu du post
    public function getContent(){
        return $this->content;
    }

    # Définit le contenu du post
    public function setContent($content){
        $this->content = $content;
        return $this;
    }

    # Retourne l'id de l'utilisateur ou null si l'utilisateur n'est pas défini
    public function getIdUser(){
        return $this->user ? $this->user->getId() : null;
    }

    # Retourne l'id du topic ou null si le topic n'est pas défini
    public function getIdTopic(){
        return $this->topic ? $this->topic->getId() : null;
    }

    # Retourne le contenu du post lorsqu'il est traité comme une chaîne
    public function __toString(){
        return $this->content;
    }
}
