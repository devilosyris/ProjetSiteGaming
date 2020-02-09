"use strict";

//---------- Afficher / Cacher profil ----------//

let btnEdit = document.getElementById("btnEdit");
let divProfil = document.getElementById("userProfil");
let divEdit = document.getElementById("userUpdate");

if ( $("#userUpdate").length) {
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
}



//---------- Supprimer les jointures ----------//
function deleteJoin(id, name)
{
     $.ajax({
        type: "GET",
        url : "monProfil",
        data : "id=" + id + "&name=" + name,
        success: function(){
            $("#block" + name + id).addClass('d-none');
            $("#input" + name + id).attr({'name' : 'delete' + name + id});
        }
    });
}

function changeUrl(url) {

	var pathName = window.location.pathname; 
	pathName = pathName.split('/');
	var folder = pathName[1];

	if(location.hostname === "localhost" || location.hostname === "127.0.0.1")
	{
        history.replaceState(null,null,window.location.protocol + "//" + window.location.host +'/'+folder+'/'+url); // localhost
     
	}
	else
	{
		history.replaceState(null,null,window.location.protocol + "//" + window.location.host +'/'+url); // OVH
    }
    
};
