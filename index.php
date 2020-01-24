<?php 
    session_start();
	// WEBROOT => dossier du projet de la racine serveur
    define('WEBROOT',str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
    // ROOT => dossier du projet de la racine du disque dur
    define('ROOT',str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
    //info en json pour description et title
    $info = json_decode(file_get_contents(ROOT.'js/info.json'));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="<?= WEBROOT ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= WEBROOT ?>css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <div class="container-fluid p-0">
        <header>
            <div id="div_TL">
            <h1>Gaming mate</h1>
            <img class="logo" src="<?= WEBROOT ?>img/twitter-picto.png" alt="twitter">
            <img class="logo" src="<?= WEBROOT ?>img/facebook_logo.png" alt="facebook">
            </div>

            <div id="div_login">
            <?php if (isset($_SESSION['id'])) {
                echo '<a href="'.WEBROOT.'User/deconnexion"><button>Déconnexion</button></a>';
            } else { ?>
                <form id="formLogin" action="<?= WEBROOT ?>User/connexion" method="POST">
                    <input type="email" name="email" class="form-control" placeholder="Entrez votre email">
                    <input type="password" name="mdp" class="form-control" placeholder="Entrez votre mot de passe">
                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                        <input type="checkbox" name="rememberme" class="custom-control-input" id="customControlInline">
                        <label class="custom-control-label" for="customControlInline">Se souvenir de moi</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Connexion</button>
                </form>
            <?php } ?>
            </div>
            
            
        </header>
        <img id="banniere" src="<?= WEBROOT ?>img/banniere.jpg" alt="bannière">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top d-sm-flex d-none" id="navDesk">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= WEBROOT ?>User/index">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link"href="<?= WEBROOT ?>#divSearch">Recherche</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= WEBROOT ?>Article/index">Actualités</a>
                </li>
                <?php if (isset($_SESSION['id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= WEBROOT ?>User/monProfil">Mon profil</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= WEBROOT ?>User/support">Support</a>
                </li>
                </ul>
            </div>
        </nav>


        <img id="imgMenu" src="<?= WEBROOT ?>img/menu.png" alt="menu">
        <nav id="navMobile">
            <a href="<?= WEBROOT ?>User/index">Accueil</a>
            <a href="<?= WEBROOT ?>#divSearch">Recherche</a>
            <a href="<?= WEBROOT ?>Article/index">Actualités</a>
            <?php if (isset($_SESSION['id'])) { ?>
            <a href="<?= WEBROOT ?>User/monProfil">Mon Profil</a>
            <?php } ?>
            <a href="<?= WEBROOT ?>User/support">Support</a>
        </nav>
        <?php 
        
            // Init 
            require_once('core/bdd.php');
            require_once('core/controller.php');
            require_once('core/abstractEntity.php');
            require_once('core/config.php');

            if(!isset($_SESSION['id']) AND isset($_COOKIE['email']) AND isset($_COOKIE['mdp']) AND !empty($_COOKIE['email']) AND !empty($_COOKIE['mdp']))
            {
                if(DB::authCheck($_COOKIE['email'],$_COOKIE['mdp']))
                {

                setcookie('email',$_COOKIE['email'],time()+$_SESSION['cookieTime'],$_SESSION['cookiePath'],$_SESSION['cookieDomain'],$_SESSION['httpsOnly'],$_SESSION['httpOnly']);
                setcookie('mdp',$_COOKIE['mdp'],time()+$_SESSION['cookieTime'],$_SESSION['cookiePath'],$_SESSION['cookieDomain'],$_SESSION['httpsOnly'],$_SESSION['httpOnly']);

                $_SESSION['id'] = htmlentities(DB::getId($_COOKIE['email'],$_COOKIE['mdp']));
                $_SESSION['email'] = htmlentities($_COOKIE['email']);
                $_SESSION['statut'] = htmlentities(DB::getStatut($_COOKIE['email'],$_COOKIE['mdp']));

                header('Location:'.WEBROOT.'User/index');
                }
            }

            // Page par default
            if (isset($_GET['p'])) {
                if ($_GET['p'] == "") {
                    $_GET['p'] = "User/index";
                }
            } else {
                $_GET['p'] = "User/index";
            }

            // Chargement du controleur
            // $tabControlleur est le tableau contenant tout les nom de controlleurs accepté par l'appli
            // à remplir avec la liste des controlleurs
            $tabControlleur = array("User","Article");
            $param = explode("/",$_GET['p']);

            // Si le nom de controller venant de l'url est dans le $tabController
            if (in_array($param[0], $tabControlleur)) {
                $controller = $param[0];
                if (isset($param[1])) {
                    $action = $param[1];
                } else {
                    $action = 'index';
                }
                // Chargement du controlleur
                require_once('controller/'.$controller.'.ctrl.php');
                // Nomage de la classe du controlleur
                $controller = 'Ctrl'.$controller;
                // Intanciation du controlleur
                $controller = new $controller();
                
                // Execution de l' $action du $controller avec les $param supplementaire si existant
                // Si action non présente dans le controleur, alors page 404
            
                // Si $action existe dans $controller
                if (method_exists($controller,$action)) {
                    // On enlève les indices 0 et 1 du tableau $param
                    unset($param[0]);
                    unset($param[1]);

                    // Ont execute $action de $controller avec $param en paramètre
                    call_user_func_array(array($controller,$action), $param);
                // Sinon $action non présente dans $controller
                } else {
                    // Page 404
                    echo 'erreur 404 (mauvaise action)';
                }
            } else {
                echo 'erreur 404 (mauvais controlleur)';
            }
            
        ?>
        <footer>
            <p class="incline">Nos partenaires</p>
            <?php
                if(isset($_SESSION['id'])){
                    if(isset($_SESSION['statut']) == 1) {
                        ?>
                            <a href="<?= WEBROOT ?>User/admin">Panel administrateur</a>
                        <?php
                    }
                }
            ?>
            <img id="footer_vert" src="<?= WEBROOT ?>img/footer.png" alt="footer vert">
            
        </footer>
    </div>
    
    
    
    <script src="<?= WEBROOT ?>js/script.js"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   
    <!-- changement de l'url en fonction de la page choisi -->
	<script>
        let url = "<?php echo $_SESSION['url']?>";
        //window.onload = changeUrl(url);
    </script>
</body>
</html>