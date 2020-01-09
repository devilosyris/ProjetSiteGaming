<?php
class CtrlUser extends Controller {
    public function index() {
        $this->loadDao('User');
        $this->info('Accueil','Bienvenue sur le site de recherche de partenaire de jeux !');
        if (isset($_SESSION['id'])) {
            $d['user'] = $this->DaoUser->read($_SESSION['id']);
            $this->set($d);
        }
        
        $this->render('User','index');
    }

    public function inscription() {
        $this->loadDao('User');
        $this->info('Inscription','N\'hésites pas à nous rejoindre, tu trouveras le cooéquipier qui te correspond.');
        // Si l'action reçois des données et que l'email fourni n'est pas dans la bdd 
        // (via l'utilisation de readByEmail de la DAO)
        if(!empty($this->input)) {
            if($this->DaoUser->readByEmail($this->input['email']) == null) {
                if(preg_match('/^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$/', $this->input['mdp']) AND preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ0-9]+$/", $this->input['pseudo'])) {
                    //creation d'un salt de cryptage
                    $salt = "2nE@5e!8";
                    //cryptage du mdp
                    $password = sha1($this->input['mdp'].$salt);
                    $nom = null;
                    $prenom = null;
                    $info = null;
                    $avatar = null;
                    $statut = null;
                    //creation d'un objet User avec les données reçues du formulaires
                    $user = new User($this->input['pseudo'], $nom, $prenom, $this->input['email'],$password, $info, $avatar, $statut);
                    //ajout de l'objet $newUser à la bdd via le create de la DAO
                    $newUser = $this->DaoUser->create($user);
                    $d['log'] = 'Inscription réussie';
                } else {
                    $d['log'] = 'Le mot de passe doit avoir :
							<ul>
							<li>Au moins une majuscule</li>
							<li>Au moins un chiffre</li>
							<li>Au moins 8 caractères</li>
							</ul>';
                }
            //A RAJOUTER un tokken + validation d'email
            } else {
                $d['log'] = "Email déjà utilisé ou formulaire d'inscription mal rempli";
                }
            $this->set($d);
            $this->render('User','inscription');
        } else {
            $this->render('User','inscription');
        }
    }

    public function connexion() {
        $this->loadDao('User');
        $this->info('Connexion','De retour parmis nous ?');
        // Si le champ sont rempli
        if(!empty($this->input)&& $this->input['email'] != "" && $this->input['mdp'] != "") {
            // Récupération de l'objet $user retourné par le readByEmail de la daoUser
            $user = $this->DaoUser->readByEmail($this->input['email']);
            if($user !=null) {
                // on ajoute le même salt au mdp envoyé pour voir si il correspond au mdp salt de la bdd
                $salt = "2nE@5e!8";
                $passUser = sha1($this->input['mdp'].$salt);
                $passBdd = $user->getMdp();
                // vérification du mdp
                if($passUser == $passBdd) {
                    
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['pseudo'] = $user->getPseudo();
                    header('Location:'.WEBROOT.'User/monProfil');
                    echo "Bienvenue ".$_SESSION['pseudo']."!";
                }
            } else {
                $d['log'] = "Email ou mot de passe incorrect";
                $this->set($d);
                $this->render('User','connexion');
            }
        } else {
            $d['log'] = "Champs non remplit";
            $this->render('User','connexion');
         }
         $this->render('User','connexion');
    }

    public function monProfil() {
        //chargement de la dao
        $this->loadDao('User');
        $this->info('Mon profil','Met ton profil en avant avec plus d\'information sur toi et tes jeux pour trouver plus facilement des joueu(ses)rs');
        
        //si la vairable session id existe (utilisateur connecté)
        if (isset($_SESSION['id'])) {
            //lecture de la fonction readAllGames pour l'affichage des jeux
            $d['games'] = $this->DaoUser->readAllGames();
            //lecture de la fonction readAllHoraires pour l'affichage des horaires
            $d['horaires'] = $this->DaoUser->readAllHoraires();
            //lecture de la fonction readAllGameplay pour l'affichage des styles
            $d['gameplay'] = $this->DaoUser->readAllGameplay();
            //affectatioin à la variable user du résultat du read via la DAO en fonction de la session id
            $d['user'] = $this->DaoUser->read($_SESSION['id']);

            $d['gamesUser'] = $this->DaoUser->readGamesByUser($_SESSION['id']);
            $d['horairesUser'] = $this->DaoUser->readHorairesByUser($_SESSION['id']);
            $d['stylesUser'] = $this->DaoUser->readGameplaysByUser($_SESSION['id']);
            //envoi des données
            $this->set($d);

            if(!empty($this->input)) {
                $id = $_SESSION['id'];
                $pseudo = htmlentities($this->input['pseudo']);
                $email = htmlentities($this->input['email']);
                $dossier = ROOT.'img/avatar/';
                $fichier = basename($this->files['avatar']['name']);
                if(move_uploaded_file($this->files['avatar']['tmp_name'],$dossier.$fichier)) {
                    $avatar = $fichier;
                }else{
                    $avatar = null;
                }
                $info = htmlentities($this->input['info']);
                
                if(!empty($this->input['game'])) {
                    $game = $this->input['game'];
                }else {
                    $game = null;
                }
                if(!empty($this->input['horaire'])){
                    $horaire = $this->input['horaire'];
                }else{
                    $horaire = null;
                }
                if(!empty($this->input['style'])){
                    $style = $this->input['style'];
                }else{
                    $style = null;
                }
                
                // Récuperer les info dans le profil non visible
                $nom = null;
                $prenom = null;
                $mdp = null;
                $statut = null;

                // Récuperer les id des jointures (game, créneaux, style)
                $gameTag = str_replace("game", "", $game);
                $gameId = intval($gameTag);
                
                $horaireTag = str_replace("creneaux", "",$horaire);
                $horaireId = intval($horaireTag);

                $styleTag = str_replace("style", "", $style);
                $styleId = intval($styleTag);

                $user = new User($pseudo, $nom, $prenom, $email, $mdp, $info, $avatar, $statut);
                $userJoin = array('game' => $gameId, 'creneaux' => $horaireId, 'style' => $styleId);
                $this->DaoUser->update($user, $userJoin, $id);
                header('Location: '.WEBROOT.'User/monProfil');
            }
        
        }

        // redirection vers user/index
        $this->render('User','monProfil');
    }

    public function deconnexion() {
        // Vide la variable de session
        session_unset();
        // destruction de la variable de session
        session_destroy();
        header('Location: '.WEBROOT.'User/index');
     }

    

    public function admin() {
        $this->loadDao('User');
        $d['users'] = $this->DaoUser->readAll();
        $this->set($d);
        $this->render('User','admin');
        if(isset($this->input)) {

        }
    }
}

?>