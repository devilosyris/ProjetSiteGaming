<?php
require_once('modele/Article.class.php');

class DaoArticle {
    public function create($article) {
        DB::select("INSERT INTO article (nom, description, image) VALUES (?,?,?)", array($article->getNom(),$article->getDescription(),$article->getImage()));
        $article->setId(DB::lastId());
        return $article;
    }
    public function read($id) {
        $donnees = DB::select("SELECT * FROM article WHERE id = ?", array($id));
        if (!empty($donnees)) {
            foreach ($donnees as $key => $donnee) {
                $article = new Article($donnee['nom'],$donnee['description'],$donnee['image']);
                $article->setId($donnee['id']);
                $article->setHoro_date($donnee['horo_date']);
                $article->setArchive($donnee['archive']);
            }  
            return $article;
        } else {
            return null;
        }
    }
    public function readAll() {
        $donnees = DB::select("SELECT * FROM article");
        if (!empty($donnees)) {
            foreach ($donnees as $key => $donnee) {
                $tabArticle[$key] = new Article($donnee['nom'],$donnee['description'],$donnee['image']);
                $tabArticle[$key]->setId($donnee['id']);
                $tabArticle[$key]->setHoro_date($donnee['horo_date']);
                $tabArticle[$key]->setArchive($donnee['archive']);
            }  
            return $tabArticle;
        } else {
            return null;
        }
    }
    public function readByName($nom) {
        $donnees = DB::select("SELECT * FROM article WHERE nom = ?", array($nom));
        if (!empty($donnees)) {
            foreach ($donnees as $key => $donnee) {
                $article = new Article($donnee['nom'],$donnee['description'],$donnee['image']);
                $article->setId($donnee['id']);
                $article->setHoro_date($donnee['horo_date']);
                $article->setArchive($donnee['archive']);
            }  
            return $article;
        } else {
            return null;
        }
    }

    public function update($article) {
        DB::select("UPDATE article SET nom = ?, description = ?, image = ?, horo_date = ?, archive = ? WHERE id = ?", array(
        $article->getNom(),
        $article->getDescription(),
        $article->getImage(),
        $article->getHoro_date(),
        $article->getArchive()
        ));
    }
    public function delete($id) {
        DB::select('DELETE FROM article WHERE id = ?', array($id));
    }
}
?>