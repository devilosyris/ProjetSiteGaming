<div class="row justify-content-center mt-5">
    <form action="<?= WEBROOT ?>User/inscription" method="POST">
        <fieldset>
            <legend>Inscription</legend>
            <div class="form-group">
                <label for="inputPseudo">Votre pseudo</label>
                <input type="text" name="pseudo" class="form-control" id="inputPseudo" placeholder="Entrez votre pseudo">
            </div>
            <div class="form-group">
                <label for="inputEmail">Votre email</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Entrez votre email">
            </div>
            <div class="form-group">
                <label for="inputPassword1">Votre mot de passe</label>
                <input type="password" name="mdp" class="form-control" id="inputPassword1" aria-describedby="mdplHelp" placeholder="Entrez votre mot de passe">
                <small id="mdpHelp" class="form-text text-muted">Ne partargez jamais votre mot de passe.</small>
            </div>
            <div class="form-group">
                <label for="inputFile">Votre avatar</label>
                <input type="file" class="form-control-file" id="inputFile" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Votre image doit être dans l'un des formats suivant : jpg, jpeg, png</small>
            </div>
            <fieldset class="form-group">
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </fieldset>
        </fieldset>
    </form>
</div>
<?php
if (isset($log)) {
    echo $log;
}
?>
