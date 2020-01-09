<?php

class User extends AbstractEntity {
    private $pseudo;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $info;
    private $avatar;
    private $statut;

    public function __construct($pseudo, $nom, $prenom, $email, $mdp, $info, $avatar, $statut) {
        $this->pseudo = $pseudo;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->info = $info;
        $this->avatar = $avatar;
        $this->statut = $statut;
    }

    public function getPseudo() {
        return $this->pseudo;
    }
    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }
    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }
    public function getPrenom() {
        return $this->prenom;
    }
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getMdp() {
        return $this->mdp;
    }
    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }
    public function getInfo() {
        return $this->info;
    }
    public function setInfo($info) {
        $this->info = $info;
    }
    public function getAvatar() {
        return $this->avatar;
    }
    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }
    public function getStatut() {
        return $this->statut;
    }
    public function setStatut($statut) {
        $this->statut = $statut;
    }
    
}
?>