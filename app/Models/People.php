<?php

namespace App\Models;

use \PDO;
use App\Utils\Database;

class People {
    protected $id;
    protected $name;
    protected $picture_url;

    public function findAll() {
        $sql = 'SELECT * FROM people';

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\\Models\\People');
    }

    public function findDirector($id) {

        $sql = 'SELECT * FROM people WHERE id = '.$id;

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchObject('App\\Models\\People');
    }

    public function findComposer($id) {

        $sql = 'SELECT * FROM people WHERE id = '.$id;

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchObject('App\\Models\\People');
    }

    public function moviesPlayedIn($id) {

        $sql = 'SELECT movie.*
            FROM people
            LEFT JOIN movie_actors ON `people`.id = `movie_actors`.people_id
            LEFT JOIN movie ON `movie_actors`.people_id = `movie`.id
            WHERE `people`.id = '.$id;

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\\Models\\Movie');
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of picture_url
     */ 
    public function getPicture_url()
    {
        return $this->picture_url;
    }

    /**
     * Set the value of picture_url
     *
     * @return  self
     */ 
    public function setPicture_url($picture_url)
    {
        $this->picture_url = $picture_url;

        return $this;
    }
}