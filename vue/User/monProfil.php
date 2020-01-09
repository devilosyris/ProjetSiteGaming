
<?php
    if (isset($user)) {
?>
<div class="row justify-content-center" >
    <div class="col-10 my-5">
        <div id="userProfil">
            <h2>Mon profil</h2>
            <!-- Info profil -->
            <div id="imageProfil"><img src="<?= WEBROOT.'img/avatar/'.htmlentities($user->getAvatar(), ENT_QUOTES) ?>"></div>
            <div id="pseudoProfil"><p>Pseudo : <?= htmlentities($user->getPseudo(), ENT_QUOTES) ?></p></div>
            <div id="gamesProfil">
                <p>Mes jeux : <!-- + classement -->
                    <?php
                        $counter = 0;
                        foreach($gamesUser as $gameUser){
                            echo $gameUser['nom'];
                            $counter ++;
                            if( $counter != (count($gamesUser))) { 
                                // Print the array content 
                                echo ", ";
                            }
                            $tabGame[] = $gameUser['nom'];
                        }
                    ?>
                </p>
            </div>
            <div id="horaireProfil">
                <p>Mes horaires : 
                    <?php
                        $counter = 0;
                        foreach($horairesUser as $horaireUser){
                            echo $horaireUser['creneaux'];
                            $counter ++;
                            if( $counter != (count($horairesUser))) { 
                                // Print the array content 
                                echo ", ";
                            }
                            $tabHoraire[] = $horaireUser['creneaux'];
                        }
                    ?>
                </p>
            </div>
            <div id="gameplayProfil">
                <p>Style de gameplay : 
                    <?php
                        $counter = 0;
                        foreach($stylesUser as $styleUser){
                            echo $styleUser['style'];
                            $counter ++;
                            if( $counter != (count($stylesUser))) { 
                                // Print the array content 
                                echo ", ";
                            }
                            $tabStyle[] = $styleUser['style'];
                        }
                    ?>
                </p>
            </div>
            <div id="infoProfil"><p>Info : <?= htmlentities($user->getInfo(), ENT_QUOTES) ?></p></div>
            <button id="btnEdit">Modifier mon profil</button>
        </div>

        <!-- Update profil form -->
        <div id="userUpdate">
            <form method="POST" action="<?= WEBROOT ?>User/monProfil" enctype="multipart/form-data">
                <fieldset>
                    <legend>Modification du profil</legend>
                    
                    <div class="form-group" >
                        <label for="pseudoProfil">Votre pseudo</label>
                        <input type="text" name="pseudo" class="form-control" id="pseudoProfil" placeholder="Entrez votre pseudo" value="<?= htmlentities($user->getPseudo(), ENT_QUOTES) ?>" />
                    </div>
                    
                    <div class="form-group">
                        <label for="emailProfil">Votre adresse email</label>
                        <input type="email" name="email" class="form-control" id="emailProfil" aria-describedby="emailHelp" placeholder="Entrez votre email" value="<?= htmlentities($user->getEmail(), ENT_QUOTES) ?>">
                        <small id="emailHelp" class="form-text text-muted">Ne partargez pas votre adresse email avec n'importe qui.</small>
                    </div>

                    <div class="form-group">
                        <label for="staticEmail" >Mes jeux</label>
                        <div class="col-sm-10">
                            <?php 
                                foreach($gamesUser as $gameUser){
                                    ?>
                                        <div class="col-sm-10">
                                            <p class="game<?= $gameUser['id'] ?>"><a class="text-danger" href="#"><i class="fas fa-minus-circle"></i> <span class="ml-3"></span> <?= $gameUser['nom'] ?></a></p> 
                                            <input type="hidden" name="readGame<?= $gameUser['id'] ?>" readonly="" class="form-control-plaintext" id="staticEmail" value="<?= $gameUser['nom'] ?>">
                                        </div>
                                    <?php
                                }
                            ?>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gamesProfil">Ajoutez un jeux</label>
                        <select name="game" class="form-control" id="gamesProfil">
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
                    
                    <div class="form-group">
                        <label for="horaireProfil">Choisissez un horaire</label>
                        <select name="horaire" class="form-control" id="horaireProfil">
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

                    <div class="form-group">
                        <label for="gameplayProfil">Choisissez votre gameplay</label>
                        <select name="style" class="form-control" id="gameplayProfil">
                            <?php
                                foreach($gameplay as $style) {
                                    if(!in_array($style['creneaux'], $tabStyle)){
                                    ?>
                                        <option value="<?= 'style'.$style['id']?>"><?= $style['style'] ?></option>
                                        <?php
                                    }
                                }
                            ?> 
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="infoProfil">Votre description</label>
                        <textarea class="form-control" name="info" id="infoProfil" rows="3" value="<?= htmlentities($user->getInfo(), ENT_QUOTES) ?>"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Valider</button>
                </fieldset>
            </form>
            <!-- <div id="imageProfil"><img src="<= WEBROOT ?>img/avatar/ <= htmlentities($user->getAvatar(), ENT_QUOTES)?>"><input type="file" name="avatar"></div> -->
        </div>
        <!-- End userUpdate --> 


    </div>
    <!-- End col-10 -->   
    
</div>
<!-- End row --> 

<?php
    }
?>