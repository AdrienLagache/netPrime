<?php

namespace App\Models;

use \PDO;
use App\Utils\Database;

class Movie {
    private $id;
    private $release_date;
    private $title;
    private $synopsis;
    private $rating;
    private $poster_url;
    private $background_url;
    private $director_id;
    private $composer_id;

    public function findAll() {

        $sql = 'SELECT * FROM movies';

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\\Models\\Movie');
    }

    public function find($id) {

        $sql = 'SELECT movies.*
            FROM movies
            WHERE `movies`.id = '.$id;

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchObject('App\\Models\\Movie');
    }

    public function findByTitle($search) {

        $sql = 'SELECT * FROM movies WHERE title LIKE "%'.$search.'%"';

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\\Models\\Movie');
    }

    public function getActors($id) {

        $sql = 'SELECT people.*
            FROM movies
            LEFT JOIN movie_actors ON `movies`.id = `movie_actors`.movie_id
            LEFT JOIN people ON `movie_actors`.actor_id = `people`.id
            WHERE `movies`.id = '.$id.'
            ORDER BY movie_actors.order';

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\\Models\\People');
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of release_date
     */ 
    public function getRelease_date()
    {
        return $this->release_date;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of synopsis
     */ 
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set the value of synopsis
     *
     * @return  self
     */ 
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of poster_url
     */ 
    public function getPoster_url()
    {
        return $this->poster_url;
    }

    /**
     * Set the value of poster_url
     *
     * @return  self
     */ 
    public function setPoster_url($poster_url)
    {
        $this->poster_url = $poster_url;

        return $this;
    }

    /**
     * Get the value of background_url
     */ 
    public function getBackground_url()
    {
        return $this->background_url;
    }

    /**
     * Set the value of background_url
     *
     * @return  self
     */ 
    public function setBackground_url($background_url)
    {
        $this->background_url = $background_url;

        return $this;
    }

    /**
     * Get the value of director_id
     */ 
    public function getDirector_id()
    {
        return $this->director_id;
    }

    /**
     * Get the value of composer_id
     */ 
    public function getComposer_id()
    {
        return $this->composer_id;
    }
}