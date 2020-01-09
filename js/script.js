"use strict";



//---------- Afficher / Cacher navbar Mobile ----------//
let imgMenu = document.getElementById("imgMenu");
let navMobile = document.getElementById("navMobile");
navMobile.style.display ="none";
imgMenu.addEventListener("click", () => {
    if(getComputedStyle(navMobile).display == "none"){
        navMobile.style.display = "flex";
        imgMenu.style.display = "none";
    }
     else {
        navMobile.style.display = "flex";
    }
});

//---------- Afficher / Cacher profil ----------//
let btnEdit = document.getElementById("btnEdit");
let divProfil = document.getElementById("userProfil");
let divEdit = document.getElementById("userUpdate");
divEdit.style.display = "none";
btnEdit.addEventListener("click", () => {
    if(getComputedStyle(divProfil).display != "none"){
        divProfil.style.display = "none";
        divEdit.style.display = "block";
    } else {
        divProfil.style.display = "block";
        divEdit.style.display = "none";
    }
});

//---------- Supprimer un jeu du profil ----------//