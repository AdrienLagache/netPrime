<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Movie;
use App\Models\People;

class MainController extends CoreController {

    /**
     * Méthode qui se charge d'afficher la page d'accueil
     *
     * @return void
     */
    public function homeAction()
    {
        $this->show('home');
    }

    /**
     * Méthode qui se charge d'afficher la page de résultats de recherche
     *
     * @return void
     */
    public function searchAction()
    {
        $searchResult = filter_input(INPUT_GET, 'search');
        $newMovie = new Movie();
        $results = $newMovie->findByTitle($searchResult);

        $this->show('result', [
            'results' => $results,
            'searchResult' => $searchResult
        ]);
    }

    public function movieAction($params)
    {
        $newMovie = new Movie();
        $movie = $newMovie->find($params['id']);
        
        $directorId = $movie->getDirector_id();
        $composerId = $movie->getComposer_id();

        $newPeople = new People();

        switch ($directorId) {
            case NULL:
                $directorName = 'UNKNOW';
                $composerPicture = $movie->getPoster_url();
                break;

            default:                
                $director = $newPeople->findDirector($directorId);

                $directorName = $director->getName();
                $directorPicture = NULL !== $director->getPicture_url() ? $director->getPicture_url() : $movie->getPoster_url();
        }

        switch ($composerId) {
            case NULL:
                $composerName = 'UNKNOW';
                $composerPicture = $movie->getPoster_url();
                break;

            default:                
                $composer = $newPeople->findDirector($composerId);

                $composerName = $composer->getName();
                $composerPicture = NULL !== $composer->getPicture_url() ? $composer->getPicture_url() : $movie->getPoster_url();
        }

        $actors = $newMovie->getActors($params['id']);
        foreach ($actors as $actor) {
            if ($actor->getPicture_url() === null) {
                $actor->setPicture_url($movie->getPoster_url());
            }
        }

        $this->show('movie', [
            'movie' => $movie,
            'directorName' => $directorName,
            'directorPicture' => $directorPicture,
            'composerName' => $composerName,
            'composerPicture' => $composerPicture,
            'actors' => $actors
        ]);
    }

    public function movieByActor() {

        $newMovie = new Movie();
        $result = $newMovie->moviesPlayedIn($params['id']);
    }
}