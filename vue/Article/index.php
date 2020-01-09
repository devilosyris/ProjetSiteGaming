<h2 class="titre_page">L'actualité autour du gaming</h2>
<?php

if(isset($articles)) {
    echo '<div id="grid_article">';
    foreach($articles as $key => $article) {
        
        echo '<div id ="article">';
        echo '<img src="'.WEBROOT.'img/article/'.htmlentities($article->getImage(), ENT_QUOTES).'">';
        echo '<h3>'.htmlentities($article->getNom(), ENT_QUOTES).'</h3>';
        echo '<div><p>'.htmlentities($article->getDescription(), ENT_QUOTES).'</p><p id="horodate">'.htmlentities($article->getHoro_date(), ENT_QUOTES).'</p></div>';
        echo '</div>';
        
    }
    echo '</div>';
}
?>