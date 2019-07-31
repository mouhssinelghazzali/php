<?php
include("connection.php");


if(isset($_GET["single"]))
{

	$data = array();
	$table["category"] = array();
	
	$variable = $_GET["single"];
	$axe = empty($_GET["axe"])?'':" AND identite='".$_GET["axe"]."'";
	$frequence = empty($_GET["frequence"])?'':" AND frequence='".$_GET["frequence"]."'";
	$vague = empty($_GET["vague"])?'':" AND vague='".$_GET["vague"]."'";
	
	$sql="SELECT libelle, var_colonne, color FROM i_graphique_structure WHERE variable='".$variable."' AND libelle NOT LIKE 'effectif' AND libelle NOT LIKE 'NPS' AND analyse='1' ORDER BY ordre";
	$requete = $bdd->query($sql);

	while($liste = $requete->fetch())
	{
		
		$sqlvaleur = "SELECT `".$liste["var_colonne"]."` FROM i_graphique WHERE 1=1 ".$axe.$frequence.$vague;
		$requetevaleur = $bdd->query($sqlvaleur);
		while($listevaleur = $requetevaleur->fetch())
		{
			if(empty($liste['color']))
			{
				array_push($data, array('label' => $liste['libelle'], 'value' => $listevaleur[$liste["var_colonne"]]));
			}
			else
			{
			array_push($data, array('label' => $liste['libelle'], 'value' => $listevaleur[$liste["var_colonne"]], 'color' => $liste['color']));
			}
		}
		$requetevaleur->closeCursor();
	}
	$requete->closeCursor();
	
echo json_encode($data);
}
elseif(isset($_GET["variable"]))
{

	$data = array();
	$table["category"] = array();
	
	$variable = $_GET["variable"];
	$typevague = empty($_GET["typevague"])?'':" AND vague LIKE '%".$_GET["typevague"]."%'";
	$axe = empty($_GET["axe"])?'':" AND identite='".$_GET["axe"]."'";
	$frequence = empty($_GET["frequence"])?'':" AND frequence='".$_GET["frequence"]."'";
	
	$sql="SELECT var_colonne FROM i_graphique_structure WHERE variable='".$variable."' AND evolution='1' ORDER BY ordre";
$requete = $bdd->query($sql);

	$liste = $requete->fetch();

		$sqlvaleur = "SELECT vague FROM i_graphique WHERE `".$liste["var_colonne"]."` IS NOT NULL".$typevague.$axe.$frequence." GROUP BY vague";
		$requetevaleur = $bdd->query($sqlvaleur);
		while($listevaleur = $requetevaleur->fetch())
		{
		array_push($table["category"], array('label' => $listevaleur["vague"]));
		}
		

		$requetevaleur->closeCursor();

	$requete->closeCursor();
	
	array_push($data,  array("category" => $table["category"]));

echo json_encode($data);
}
elseif(isset($_GET["valeur"]))
{
	$data = array();
	$vague = array();
	$variable = $_GET["valeur"];
	$typevague = empty($_GET["typevague"])?'':" AND vague LIKE '%".$_GET["typevague"]."%'";
	$axe = empty($_GET["axe"])?'':" AND identite='".$_GET["axe"]."'";
	$frequence = empty($_GET["frequence"])?'':" AND frequence='".$_GET["frequence"]."'";
	
	$madata = array();
	// CALCUL DES VAGUES
	/*
	$sql="SELECT var_colonne FROM i_graphique_structure WHERE variable='".$variable."' AND libelle NOT LIKE 'effectif' AND analyse='1' AND ordre='1'";
	$requete = $bdd->query($sql);
	$liste = $requete->fetch();

		$sqlvaleur = "SELECT vague FROM i_graphique WHERE ".$liste["var_colonne"]." IS NOT NULL".$axe." GROUP BY vague";
		$requetevaleur = $bdd->query($sqlvaleur);
		while($listevaleur = $requetevaleur->fetch())
		{
		array_push($vague, $listevaleur["vague"]);
		}
		$requetevaleur->closeCursor();
	$requete->closeCursor();
	*/
	
	// On a récupéré les vagues, on va pouvoir définir nos requêtes
	$sql="SELECT libelle, var_colonne, color FROM i_graphique_structure WHERE variable='".$variable."' AND evolution='1' ORDER BY ordre";
	$requete = $bdd->query($sql);
	while($liste = $requete->fetch())
	{
		$sqlvaleur = "SELECT `".$liste["var_colonne"]."`, vague FROM i_graphique WHERE 1=1 ".$typevague.$axe.$frequence." GROUP BY vague";
		$requetevaleur = $bdd->query($sqlvaleur);
		$table1 = array();
		while($listevaleur = $requetevaleur->fetch())
		{
			//if(in_array($listevaleur["vague"], $vague)){array_push($vague, $listevaleur["vague"]);}
			//$madata[$liste["var_colonne"]][$listevaleur["vague"]] = $listevaleur[$liste["var_colonne"]];
			array_push($table1,array('value' => $listevaleur[$liste["var_colonne"]]));
		}
		$requetevaleur->closeCursor();
		if(empty($liste["color"])) {$uneserie = array("seriesname"=> $liste["libelle"], "data" => $table1);}
		else {$uneserie = array("seriesname"=> $liste["libelle"], "data" => $table1,'color' => $liste["color"]);}
		array_push($data, $uneserie);
	}
	$requete->closeCursor();

echo json_encode($data);
}
elseif(isset($_GET["effectif"]))
{
	$data = "";

	$effectif = $_GET["effectif"];
	$vague = empty($_GET["vague"])?'':" AND vague='".$_GET["vague"]."'";
	$axe = empty($_GET["axe"])?'':" AND identite='".$_GET["axe"]."'";
	$frequence = empty($_GET["frequence"])?'':" AND frequence='".$_GET["frequence"]."'";
	
	// Récupération de l'effectif base répondant
	$sql="SELECT libelle, var_colonne FROM i_graphique_structure WHERE variable='".$effectif."' AND libelle LIKE 'effectif' AND analyse='1' LIMIT 1";
	$requete = $bdd->query($sql);
	$liste = $requete->fetch();

	if(!empty($liste))
	{
		// TODO récupérer la valeur correspondant aux var_colonne
		$sqlvaleur = "SELECT `".$liste["var_colonne"]."` FROM i_graphique WHERE 1=1 ".$vague.$axe.$frequence." LIMIT 1";
		//echo $sqlvaleur;
		$requetevaleur = $bdd->query($sqlvaleur);
		$listevaleur = $requetevaleur->fetch();

		if($listevaleur[$liste["var_colonne"]]<30)
		{	$data = "⚠ Base répondants Faibles: ".$listevaleur[$liste["var_colonne"]];}
		else
		{	$data = "Base répondants : ".$listevaleur[$liste["var_colonne"]];}
		
		$requetevaleur->closeCursor();
	}
	$requete->closeCursor();
	
	// Récupération de le NPS
	$sqlnps="SELECT libelle, var_colonne FROM i_graphique_structure WHERE variable='".$effectif."' AND libelle LIKE 'NPS' AND analyse='1' LIMIT 1";
	$requetenps = $bdd->query($sqlnps);
	$listenps = $requetenps->fetch();

	if(!empty($listenps))
	{
		// TODO récupérer la valeur correspondant aux var_colonne
		$sqlvaleurnps = "SELECT `".$listenps["var_colonne"]."` FROM i_graphique WHERE 1=1 ".$vague.$axe.$frequence." LIMIT 1";
		//echo $sqlvaleur;
		$requetevaleurnps = $bdd->query($sqlvaleurnps);
		$listevaleurnps = $requetevaleurnps->fetch();
		$data .= "{br}NPS : ".$listevaleurnps[$listenps["var_colonne"]];
		$requetevaleurnps->closeCursor();
	}
	$requetenps->closeCursor();
	
	// Récupération de le(s) indicateur(s)
	$sqlindic="SELECT libelle, var_colonne FROM i_graphique_structure WHERE variable='".$effectif."' AND indicateur='1' ORDER BY ordre";
	$requeteindic = $bdd->query($sqlindic);
	//$listenps = $requetenps->fetch();
	while($listeindic = $requeteindic->fetch())
	{
		if(!empty($listeindic))
		{
			// TODO récupérer la valeur correspondant aux var_colonne
			$sqlvaleurindic = "SELECT `".$listeindic["var_colonne"]."` FROM i_graphique WHERE 1=1 ".$vague.$axe.$frequence." LIMIT 1";
			//echo "<p>".$sqlvaleurindic."</p>";
			$requetevaleurindic = $bdd->query($sqlvaleurindic);
			$listevaleurindic = $requetevaleurindic->fetch();
			$data .= "{br}".$listeindic["libelle"]." : ".$listevaleurindic[$listeindic["var_colonne"]]." %";
			$requetevaleurindic->closeCursor();
		}
	}
	$requeteindic->closeCursor();
	
	echo $data;
}


?>