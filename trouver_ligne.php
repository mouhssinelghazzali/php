<?php
//Variable de connection
require_once("connection.php");
$date = date("Y-m-d");
if(isset($_GET['annee']))
{
	$annee = $_GET['annee'];
	$t_fichiers = "t_fichiers";
	$t_structure = "t_structure";
}
elseif(isset($_GET['filtrannee']))
{
	if($_GET['filtrannee']=="evol")
	{
		$filtrannee = "";
	}
	else
	{
		$filtrannee = " AND annee='".$_GET['filtrannee']."' ";
	}
	$t_fichiers = "t_fichiers";
	$t_structure = "t_structure";
}
else
{
	$filtrannee = "";
	$t_fichiers = "t_fichiers";
	$t_structure = "t_structure";
}

if(isset($_GET['fichier']))
{
	$reqq = $bdd->query("UPDATE `".$t_fichiers."`SET `date_download`= '".$date."' WHERE`".$t_fichiers."`.`id_fichier`=".$_GET['fichier']);
	echo date("d/m/Y");
}


?>