
<?php
    if (isset($_SESSION['id'])) {
?>
<div class="row justify-content-center" >
    <div class="col-md-8 my-5">
        <div id="userProfil">
            <h2 class="text-center">Mon profil</h2>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-9 pt-3 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-lg-9 col-md-6">
                                        <h3 class="mb-0 text-truncated"><?= htmlentities($user->getPseudo(), ENT_QUOTES) ?></h3>
                                        <p class="mt-3">
                                            <?= htmlentities($user->getInfo(), ENT_QUOTES) ?>
                                        </p>
                                        <p> 
                                            <legend> Mes jeux :
                                                <span>
                                                <?php
                                                    $counter = 0;
                                                    foreach($gamesUser as $gameUser){
                                                        echo '<span class="badge badge-danger m-1">'.$gameUser['nom'].'</span>';
                                                        $counter ++;
                                                        if( $counter != (count($gamesUser))) { 
                                                            // Print the array content 
                                                            echo " ";
                                                        }
                                                        $tabGame[] = $gameUser['nom'];
                                                    }
                                                ?>
                                                </span> 
                                            </legend>
                                            <legend> Mes horaires :
                                                <span>
                                                <?php
                                                    $counter = 0;
                                                    foreach($horairesUser as $horaireUser){
                                                        echo '<span class="badge badge-warning m-1">'.$horaireUser['creneaux'].'</span>';
                                                        $counter ++;
                                                        if( $counter != (count($horairesUser))) { 
                                                            // Print the array content 
                                                            echo " ";
                                                        }
                                                        $tabHoraire[] = $horaireUser['creneaux'];
                                                    }
                                                ?>
                                                </span>
                                            </legend>
                                            <legend> Mes styles :
                                                <span>
                                                <?php
                                                    $counter = 0;
                                                    foreach($stylesUser as $styleUser){
                                                        echo '<span class="badge badge-info m-1">'.$styleUser['style'].'</span>';
                                                        $counter ++;
                                                        if( $counter != (count($stylesUser))) { 
                                                            // Print the array content 
                                                            echo " ";
                                                        }
                                                        $tabStyle[] = $styleUser['style'];
                                                    }
                                                ?>
                                                </span>
                                            </legend>
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-3 col-sm-2">
                                        <img src="<?= WEBROOT.'img/avatar/'.htmlentities($user->getAvatar(), ENT_QUOTES) ?>" alt="" class="mx-auto rounded-circle img-fluid d-block py-5">
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <button class="btn btn-block btn-outline-success"><span class="fa fa-plus-circle"></span> Ajouter en ami</button>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <button class="btn btn-outline-info btn-block"><span class="fas fa-comment-dots"></span> Envoyer un message </button>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <button type="button" class="btn btn-outline-danger btn-block"><span class="fas fa-exclamation-triangle"></span> Signaler </button>
                                    </div>
                                    <div class="col-12 col-lg-3 d-flex align-items-end justify-content-center">
                                        <button id="btnEdit" type="button" class="btn btn-primary btn-sm col-md-6 col-sm-10">Modifier mon profil</button>
                                    </div>
                                    <!--/col-->
                                </div>
                                <!--/row-->
                            </div>
                            <!--/card-block-->
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <!-- End profil -->

    <!-- Update profil form -->
    <div class="col-5">
        <div id="userUpdate" class="row justify-content-center">
            <div class="col-12">
                <form method="POST" action="<?= WEBROOT ?>User/monProfil" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Modification du profil</legend>
                        <!-- update pseudo  -->
                        <div class="form-group" >
                            <label for="pseudoProfil">Votre pseudo</label>
                            <input type="text" name="pseudo" class="form-control" id="pseudoProfil" placeholder="Entrez votre pseudo" value="<?= htmlentities($user->getPseudo(), ENT_QUOTES) ?>" />
                        </div>
                        
                        <!-- update email  -->
                        <div class="form-group">
                            <label for="emailProfil">Votre adresse email</label>
                            <input type="email" name="email" class="form-control" id="emailProfil" aria-describedby="emailHelp" placeholder="Entrez votre email" value="<?= htmlentities($user->getEmail(), ENT_QUOTES) ?>">
                            <small id="emailHelp" class="form-text text-muted">Ne partargez pas votre adresse email avec n'importe qui.</small>
                        </div>

                        <!-- update jeux  -->
                        <div class="form-group">
                            <label for="staticEmail">Mes jeux</label>
                            <div class="col-sm-10">
                                <?php 
                                    foreach($gamesUser as $gameUser){
                                        ?>
                                            <div class="col-sm-10">
                                                <p id="blockGame<?= $gameUser['id'] ?>" OnClick="deleteJoin(<?= $gameUser['id'] ?>, 'Game');">
                                                    <span class="mr-3 text-danger"><i class="fas fa-minus-circle"></i></span>  <?= $gameUser['nom'] ?>
                                                </p> 
                                                <input type="hidden" id="inputGame<?= $gameUser['id'] ?>" name="readGame" readonly="" class="form-control-plaintext" id="staticEmail" value="<?= $gameUser['nom'] ?>">
                                            </div>
                                            
                                        <?php
                                    }
                                ?>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gamesProfil">Ajoutez un jeux</label>
                            <select name="game" class="form-control" id="gamesProfil">
                                <option value="" selected></option>
                                <?php
                                    foreach($games as $game){
                                
                                        if(!in_array($game['nom'], $tabGame)){
                                ?>
                                                <option value="<?= 'game'.$game['id'] ?>"><?= $game['nom'] ?></option>
                                            <?php
                                        } 
                                    }
                                ?>
                            </select>
                        </div>
                        <!-- fin update jeux  -->
                        
                        <!-- Update horaire  -->
                         <div class="form-group">
                            <label for="staticEmail">Mes horaires</label>
                            <div class="col-sm-10">
                                <?php 
                                    foreach($horairesUser as $horaireUser){
                                        ?>
                                            <div class="col-sm-10">
                                                <p id="blockHoraire<?= $horaireUser['id'] ?>" OnClick="deleteJoin(<?= $horaireUser['id'] ?>, 'Horaire');">
                                                    <span class="mr-3 text-danger"><i class="fas fa-minus-circle"></i></span>  <?= $horaireUser['creneaux'] ?>
                                                </p> 
                                                <input type="hidden" id="inputHoraire<?= $horaireUser['id'] ?>" name="readHoraire" readonly="" class="form-control-plaintext" id="staticEmail" value="<?= $horaireUser['creneaux'] ?>">
                                            </div>
                                            
                                        <?php
                                    }
                                ?>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="horaireProfil">Choisissez un horaire</label>
                            <select name="horaire" class="form-control" id="horaireProfil">
                                <option value="" selected></option>
                                <?php
                                    foreach($horaires as $horaire) {
                                        if(!in_array($horaire['creneaux'], $tabHoraire)){
                                ?>
                                        <option value="<?= 'creneaux'.$horaire['id']?>"><?= $horaire['creneaux'] ?></option>
                                            <?php
                                        } 
                                    }
                                ?>
                            </select>
                        </div>
                        <!-- Fin update horaire  -->

                        <!-- Update gameplay  -->
                        <div class="form-group">
                            <label for="staticEmail">Mes style de gameplay</label>
                            <div class="col-sm-10">
                                <?php 
                                    foreach($stylesUser as $styleUser){
                                        ?>
                                            <div class="col-sm-10">
                                                <p id="blockStyle<?= $styleUser['id'] ?>" OnClick="deleteJoin(<?= $styleUser['id'] ?>, 'Style');">
                                                    <span class="mr-3 text-danger"><i class="fas fa-minus-circle"></i></span>  <?= $styleUser['style'] ?>
                                                </p> 
                                                <input type="hidden" id="inputStyle<?= $styleUser['id'] ?>" name="readStyle" readonly="" class="form-control-plaintext" id="staticEmail" value="<?= $styleUser['style'] ?>">
                                            </div>
                                            
                                        <?php
                                    }
                                ?>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gameplayProfil">Choisissez votre gameplay</label>
                            <select name="style" class="form-control" id="gameplayProfil">
                            <option value="" selected></option>
                                <?php
                                    foreach($gameplay as $style) {
                                        if(!in_array($style['style'], $tabStyle)){
                                        ?>
                                            <option value="<?= 'style'.$style['id']?>"><?= $style['style'] ?></option>
                                            <?php
                                        }
                                    }
                                ?> 
                            </select>
                        </div>
                        <!-- Fin update gameplay  -->
                        
                        <!-- Update description  -->
                        <div class="form-group">
                            <label for="infoProfil">Votre description</label>
                            <textarea class="form-control" name="info" id="infoProfil" rows="3" placeholder="Votre description"><?= htmlentities($user->getInfo(), ENT_QUOTES) ?></textarea>
                        </div>
                        <!-- Fin update description -->
                        
                        <!-- Update avatar  -->
                        <div class="form-group">
                            <label for="inputFile">Votre avatar</label>
                            <input type="file" name="avatar" class="form-control-file" id="inputFile" aria-describedby="fileHelp">
                            <small id="fileHelp" class="form-text text-muted">Votre fichier doit être au format JPEG, JPG ou PNG</small>
                        </div>
                        <!-- Fin update avatar  -->

                        <button type="submit" class="btn btn-primary">Valider</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- End userUpdate --> 
    </div>
    <!-- End col-10 -->   
</div>
<!-- End row --> 
<?php

}

?>
