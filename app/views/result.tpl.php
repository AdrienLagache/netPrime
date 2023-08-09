<h1 class="result-title">Résultats de la recherche : <span><?=$searchResult?></span></h1>
<section class="results">

<?php foreach ($results as $result):?>
    <a href="<?=$router->generate('movie', ['id' => $result->getId()])?>" class="movie-result">
        <img src="<?=$pictureUrl.$result->getPoster_url()?>" alt="<?=$result->getTitle()?>">
        <h3>
            <?=$result->getTitle()?>
        </h3>
    </a>
<?php endforeach;?>

</section>