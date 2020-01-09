<?php
class Article extends AbstractEntity {
    private $nom;
    private $description;
    private $image;
    private $horo_date;
    private $archive;

    public function __construct($nom, $description, $image) {
        $this->nom = $nom;
        $this->description = $description;
        $this->image = $image;
    }

    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }
    public function getDescription() {
        return $this->description;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function getImage() {
        return $this->image;
    }
    public function setImage($image) {
        $this->image = $image;
    }
    public function getHoro_date() {
        return $this->horo_date;
    }
    public function setHoro_date($horo_date) {
        $this->horo_date = $horo_date;
    }
    public function getArchive() {
        return $this->archive;
    }
    public function setArchive($archive) {
        $this->archive = $archive;
    }
}
?>