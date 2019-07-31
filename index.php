<?php
// Inialize session
session_start();
// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['username'])) {
header('Location: login.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>SNCF</title>
    <meta name="robots" content="noindex, nofollow">
	<META NAME="robots" CONTENT="noarchive">
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
    <meta name="viewport" content="width=device-width">

    
<link rel="shortcut icon" href="img/favicon.ico" />
<link rel="icon" href="img/favicon.ico" />
<link rel="stylesheet" media="screen" type="text/css" title="Exemple" href="style.css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<style>
.material-icons.md-dark { color: rgba(0, 0, 0, 0.54); }
.material-icons {vertical-align: top;}
</style>      
<script type="text/javascript">
// Fonction Ajax
 function file(fichier)
	{
	if(window.XMLHttpRequest) // FIREFOX
	xhr_object = new XMLHttpRequest();
	else if(window.ActiveXObject) // IE
	xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
	else
	return(false);
	xhr_object.onreadystatechange = function() {if(xhr_object.readyState<4) document.getElementById("idload").style.display = "inline";}

	xhr_object.open("GET", fichier, false);
	xhr_object.send(null);
	
		if(xhr_object.readyState == 4)
		{
			document.getElementById("idload").style.display="none";
			return(xhr_object.responseText);
		}
		else
		{
			return(false);
		}
	}

// Fonction de mise à jour de la date de téléchargement	
function majdownload(id_fichier){
	document.getElementById(id_fichier).innerHTML= file("trouver_ligne.php?fichier="+id_fichier);
}

function checkAll(checked){
    //On parcourt tous les inputs de la page
    var inputs = document.getElementsByTagName('input');
    for(var i=0; i<inputs.length; i++){
        //On regarde s'il s'agit d'une checkbox avec le nom souhaité
        //if(inputs[i].type == 'checkbox'){
		if(inputs[i].name == 'case[]'){
            //On attribue à la case le même état (coché/décoché) que celui de la checkbox servant à tout cocher/décocher
            inputs[i].checked = checked;
			// if(checked == true) {cocher(inputs[i].id)} // Pas besoin, on fait un update lors du zip
        }
    }
}
//Voici les fonctions pour la mise à jour des dates de téléchargements en multi via le ziparchive
var tablecase = new Array();
function cocher(id_fichier){
	var idf = id_fichier;
tablecase.push(idf);
//alert(tablecase[tablecase.length-1]);
}

// Lors du clic sur le zip
function majdownload2(){
	for (i=0; i<tablecase.length; i++) 
	{
		document.getElementById(tablecase[i]).innerHTML= file("trouver_ligne.php?fichier="+tablecase[i]);
	}
	tablecase = new Array();
	//checkAll(false); Si on décoche tout, il n'y aura aucun fichier à zipper et à télécharger !
}
if (document.body)
{
var haut = (document.body.clientHeight);
}
else
{
var haut = (window.innerHeight);
}
//alert(haut);
</script>

  </head>
  <body>
<?php include('menu.php');?>

  <span id="idload" style="display:none; background-color:rgba(255, 255, 255, 0.3); border-radius:5px;"><img src="img/ajax-loader.gif" alt="loading"> chargement en cours... </span>
<div id="corps">
<?php
include("connection.php");

$include = array();
$include[1] = "accueil.php";
$include[2] = "avancement.php";
$include[3] = "graphique.php";//"planning.php";
$include[4] = "rapports.php";
$include[5] = "documentation.php";
$include[6] = "contact.php";
$include[7] = "graphique.php";
$include[8] = "classement.php";
$include[9] = "remontee.php";
$include[10] = "utilisateurs.php";
$include[11] = "rapports.php";
$include[12] = "evolution.php";
$include[13] = "indicateurs.php";
$include[14] = "evolutionindicateurs.php";
$include[15] = "dynamique.php";
if( isset($_GET['id']))
{
	if($_GET['id'] >15){ echo "<p>page inexistante</p>"; } else {
	require_once($include[$_GET['id']]);}
	}
	else
	{
		require_once($include[3]);
		}
?>
</div>
  </body>
</html>