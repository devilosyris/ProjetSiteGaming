<div id="divSupp" class="justify-content-center mt-5">
    <p class="textSupp">Un problème avec un utilisateur ? Votre compte ? ou autres… Vous êtes au bon endroit !</p>
    <form id="formSupp" action="<?= WEBROOT ?>User/support" method="POST">
        <fieldset>
            <legend>Un problème ? Contactez notre support</legend>
            <div class="form-group">
                <label for="inputSujet">Sujet</label>
                <input type="text" name="sujet" class="form-control" id="inputSujet" placeholder="Entrez le sujet du problème">
            </div>
            <div class="form-group">
                
                <textarea name="description" id="inputDescription" rows="5" placeholder="Description du problème..."></textarea>
            </div>
            <div class="form-group">
                <label for="inputPseudo">Votre pseudo</label>
                <input type="text" name="pseudo" class="form-control" id="inputPseudo" placeholder="Entrez votre pseudo">
            </div>
            <div class="form-group">
                <label for="inputEmail">Votre email</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Entrez votre email">
            </div>
            <div class="form-group">
                <label for="inputFile">Votre image</label>
                <input type="file" class="form-control-file" id="inputFile" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Votre image doit être dans l'un des formats suivant : jpg, jpeg, png</small>
            </div>
            <fieldset class="form-group">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </fieldset>
        </fieldset>
    </form>
    <p class="textSupp">Notre équipe fera au mieux pour vous aider et vous répondre dans les plus bref délais</p>
</div>