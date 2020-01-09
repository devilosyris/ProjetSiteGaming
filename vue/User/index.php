
<!-- Si pas de membres connecté -->
<?php if (!isset($_SESSION['id'])) { ?>
    <img class="separateur" src="<?= WEBROOT ?>././img/separateur.png" alt="separation">
    <div id="divWelcome">
        <p id="textBvn"> Bienvenue sur le site qui te permettra de trouver les partenaires de jeu idéal !</p>
        <p class="textPres">La section de recherche t'aidera à choisir un profil en fonction des critères qui te corresponde au mieux ..</p>
        <p class="textPres">Un système de recherche facile d'utilisation, une personnalisation de son profil et des actualités gaming !</p>
    </div>
    <button id="btnSign">
        <a href="<?= WEBROOT ?>User/inscription">S'inscrire</a>
    </button>
    <img class="separateur" src="<?= WEBROOT ?>././img/separateur.png" alt="separation">
<?php } ?>

<h3 id="titreSlide">Nos membres</h3>

<!-- slider des membres -->


<!-- recherche de partenaire -->
<div id="divSearch">
    <h3 id="titreSearch">Besoin d'un(e) partenaire de jeux ?</h3>
        <form id="formSearch" action="recherche.php">
            <input id="inputSearch" type="text" placeholder=" &#x1F50D; Nom du joueur...">
            <select name="games" id="gameSelect">
                <option selected disabled>-- Jeux rechercher --</option>
                <?php 
                $game = DB::select('SELECT nom FROM game');
                foreach ($game as $values) {
                    foreach ($values as $value) {
                        ?>
                        <option><?=$value?></option>
                <?php
                    }
                }
                ?> 
            </select>
            <select name="players" id="playerSelect">
                <option selected disabled>-- Type de joueur --</option>
                    <?php 
                    $style = DB::select('SELECT style FROM gameplay');
                    foreach ($style as $values) {
                        foreach ($values as $value) {
                            ?>
                            <option><?=$value?></option>
                    <?php
                        }
                    }
                    ?> 
            </select>
            <select name="dispo" id="dispoSelect">
                <option selected disabled>-- Disponibilité --</option>
                    <?php 
                    $creneaux = DB::select('SELECT creneaux FROM horaire');
                    foreach ($creneaux as $values) {
                        foreach ($values as $value) {
                            ?><option><?=$value?></option> 
                    <?php
                        }
                    }
                    ?> 
            </select>
            <input id="btnSearch" type="submit" value="Rechercher">
        </form>
</div>
    <!-- fin de recherche -->
        
