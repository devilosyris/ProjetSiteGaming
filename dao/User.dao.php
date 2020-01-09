<?php
require_once('modele/User.class.php');

class DaoUser {
    public function create($user) {
        DB::select("INSERT INTO user (pseudo, email, mdp) VALUES (?,?,?)", array($user->getPseudo(),$user->getEmail(),$user->getMdp()));
        $user->setId(DB::lastId());
        return $user;
    }

    public function read($id) {
        $donnees = DB::select("SELECT * FROM user WHERE id = ?", array($id));
        if (!empty($donnees)) {
            foreach ($donnees as $key => $donnee) {
                $user = new User($donnee['pseudo'], $donnee['nom'], $donnee['prenom'] , $donnee['email'], $donnee['mdp'], $donnee['info'], $donnee['avatar'], $donnee['statut']);
                $user->setId($donnee['id']);
                $user->setNom($donnee['nom']);
                $user->setPrenom($donnee['prenom']);
                $user->setInfo($donnee['info']);
                $user->setAvatar($donnee['avatar']);
                $user->setStatut($donnee['statut']);
            }  
            return $user;
        } else {
            return null;
        }
    }
    public function readAll() {
        $donnees = DB::select("SELECT * FROM user");
        if (!empty($donnees)) {
            foreach ($donnees as $key => $donnee) {
                $tabUser[$key] = new User($donnee['pseudo'], $donnee['nom'], $donnee['prenom'] , $donnee['email'], $donnee['mdp'], $donnee['info'], $donnee['avatar'], $donnee['statut']);
                $tabUser[$key]->setId($donnee['id']);
                $tabUser[$key]->setNom($donnee['nom']);
                $tabUser[$key]->setPrenom($donnee['prenom']);
                $tabUser[$key]->setInfo($donnee['info']);
                $tabUser[$key]->setAvatar($donnee['avatar']);
                $tabUser[$key]->setStatut($donnee['statut']);
            }  
            return $tabUser;
        } else {
            return null;
        }
    }
    public function readAllGames() {
        $donnees = DB::select('SELECT * FROM game');
        return $donnees;
    }
    public function readAllHoraires() {
        $donnees = DB::select('SELECT * FROM horaire');
        return $donnees;
    }
    public function readAllGameplay() {
        $donnees = DB::select('SELECT * FROM gameplay');
        return $donnees;
    }

    public function readGamesByUser($id) {
        $donnees = DB::select('SELECT g.id, g.nom FROM user_game ug INNER JOIN user u ON u.id = ug.id_user INNER JOIN game g ON g.id = ug.id_game WHERE u.id = ?', array(
            $id
        ));
        return $donnees;
    }

    public function readHorairesByUser($id) {
        $donnees = DB::select('SELECT h.id, h.creneaux FROM user_horaire uh INNER JOIN user u ON u.id = uh.id_user INNER JOIN horaire h ON h.id = uh.id_horaire WHERE u.id = ?', array(
            $id
        ));
        return $donnees;
    }

    public function readGameplaysByUser($id) {
        $donnees = DB::select('SELECT gp.id, gp.style FROM user_gameplay ugp INNER JOIN user u ON u.id = ugp.id_user INNER JOIN gameplay gp ON gp.id = ugp.id_gameplay WHERE u.id = ?', array(
            $id
        ));
        return $donnees;
    }
    
    public function readByPseudo($pseudo) {
        $donnees = DB::select("SELECT * FROM user WHERE pseudo = ?", array($pseudo));
        if (!empty($donnees)) {
            foreach ($donnees as $key => $donnee) {
                $user = new User($donnee['pseudo'], $donnee['nom'], $donnee['prenom'] , $donnee['email'], $donnee['mdp'], $donnee['info'], $donnee['avatar'], $donnee['statut']);
                $user->setId($donnee['id']);
                $user->setNom($donnee['nom']);
                $user->setPrenom($donnee['prenom']);
                $user->setInfo($donnee['info']);
                $user->setAvatar($donnee['avatar']);
                $user->setStatut($donnee['statut']);
            }  
            return $user;
        } else {
            return null;
        }
    }
    
    public function readByEmail($email) {
        $donnees = DB::select("SELECT * FROM user WHERE email = ?", array($email));
        if (!empty($donnees)) {
            foreach ($donnees as $key => $donnee) {
                $user = new User($donnee['pseudo'], $donnee['nom'], $donnee['prenom'] , $donnee['email'], $donnee['mdp'], $donnee['info'], $donnee['avatar'], $donnee['statut']);
                $user->setId($donnee['id']);
                $user->setNom($donnee['nom']);
                $user->setPrenom($donnee['prenom']);
                $user->setInfo($donnee['info']);
                $user->setAvatar($donnee['avatar']);
                $user->setStatut($donnee['statut']);
            }  
            return $user;
        } else {
            return null;
        }
    }

    public function update($user, $userJoin, $id) {
        
        DB::select("UPDATE user SET pseudo = ?, email = ?, info = ?, avatar = ? WHERE id = ?", 
        array(
            $user->getPseudo(),
            $user->getEmail(),
            $user->getInfo(),
            $user->getAvatar(),
            $id
        ));

        if($userJoin['game']){
            DB::select("INSERT INTO user_game (id_user, id_game) VALUES (?,?)", array(
                $id, $userJoin['game']
            ));
        }

        if($userJoin['creneaux']) {
            DB::select("INSERT INTO user_horaire (id_user, id_horaire) VALUES (?,?)", array(
                $id, $userJoin['creneaux']
            ));
        }

        if($userJoin['style']) {
            DB::select("INSERT INTO user_gameplay (id_user, id_gameplay) VALUES (?,?)", array(
                $id, $userJoin['style']
            ));
        }



    }

    public function delete($userJoinObject, $userJoinId){
        DB::select('DELETE FROM ? WHERE id = ?', array( $userJoinObject, $userJoinId));
    }
}

?>