<?php
session_start();

include("connection.php");

$tab_entite = array();
$sqlstructure = "SELECT identite, auteur FROM t_user GROUP BY identite";
$reqstructure = $bdd->query($sqlstructure);
while($list_struc = $reqstructure->fetch())
{
	$tab_entite[$list_struc['identite']] = $list_struc['auteur'];
}
$reqstructure->closeCursor();

//$identite = $_SESSION['identite'];
if (isset($_GET['identite'])){$identite = $_GET['identite'];}else{$identite = $_SESSION['identite'];}
if (isset($_GET['type'])){$filtretype = " AND type='".$_GET['type']."'";}else{$filtretype = "";}

$nombreDeMessagesParPage = 40;
if (isset($_GET['colonne'])){$ordre=' ORDER BY '.$_GET['colonne'].' '.$_GET['triage'];}else{$ordre='';};
		
if (!empty($_GET['vague']))
{	$filtrevague = " AND vague ='".$_GET['vague']."'";} else {	$filtrevague = "";}

	if (isset($_GET['page'])){$page = $_GET['page'];}else{$page = 1;}
	$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
	
	/*if($_SESSION['type'] == 0)
	{
	$sql = 'SELECT id_fichier, fichier, identite, type, vague, date_download, date_fichier FROM t_fichiers WHERE identite="'.$identite.'"'.$filtrevague.$filtretype.' ORDER BY fichier LIMIT '. $premierMessageAafficher.', '.$nombreDeMessagesParPage;
	$affichage = true;
	$sqlcount = 'SELECT id_fichier FROM t_fichiers WHERE identite="'.$identite.'"'.$filtrevague.$filtretype;
	}
	else
	{*/
	$sql = 'SELECT * FROM (SELECT id_fichier, fichier, identite, type, vague, date_download, date_fichier FROM t_fichiers INNER JOIN t_structure ON t_fichiers.identite = t_structure.num_niv4 WHERE (num_niv3 like "'.$identite.'" OR num_niv4 like "'.$identite.'")'.$filtrevague.$filtretype.' AND SUBSTRING(vague, 1, 4) = annee GROUP BY fichier UNION
	SELECT id_fichier, fichier, identite, type, vague, date_download, date_fichier FROM t_fichiers INNER JOIN t_structure ON t_structure.num_niv3 = t_fichiers.identite WHERE t_structure.num_niv3 like "'.$identite.'"'.$filtrevague.$filtretype.' AND SUBSTRING(vague, 1, 4) = annee GROUP BY fichier) AS tmp '.$ordre.' LIMIT '. $premierMessageAafficher.', '.$nombreDeMessagesParPage;
	
	$affichage = true;
	$sqlcount = 'SELECT id_fichier FROM (SELECT id_fichier, fichier, identite, type, vague, date_download, date_fichier FROM t_fichiers INNER JOIN t_structure ON t_fichiers.identite = t_structure.num_niv4 WHERE (num_niv3 like "'.$identite.'" OR num_niv4 like "'.$identite.'")'.$filtrevague.$filtretype.' AND SUBSTRING(vague, 1, 4) = annee GROUP BY fichier UNION
	SELECT id_fichier, fichier, identite, type, vague, date_download, date_fichier FROM t_fichiers INNER JOIN t_structure ON t_structure.num_niv3 = t_fichiers.identite WHERE t_structure.num_niv3 like "'.$identite.'"'.$filtrevague.$filtretype.' AND SUBSTRING(vague, 1, 4) = annee GROUP BY fichier) AS tmp';
	//}
	
//echo $sql;
/*
if (isset($_GET['clef']))
{
	$clef = $_GET['clef'];
	?>
	<?php
	if (isset($_GET['page'])){$page = $_GET['page'];}else{$page = 1;}
	$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
	
	if($type <= 4)
	{
		if($_SESSION['type'] == 4){$controle = ' AND num_niv4="'.$identite.'"';}
		$sql2 = 'SELECT id_fichier, date_download, date_fichier, fichier, identite, vague, lib_niv3, lib_niv4 FROM t_fichiers INNER JOIN t_structure ON num_niv4 = identite WHERE lib_niv4 like "%'.$clef.'%"'.$controle.$ordre.' LIMIT '. $premierMessageAafficher.', '.$nombreDeMessagesParPage;
		$sqlcount = 'SELECT id_fichier, date_download, date_fichier, fichier, identite, vague, lib_niv3, lib_niv4 FROM t_fichiers INNER JOIN t_structure ON num_niv4 = identite WHERE lib_niv4 like "%'.$clef.'%"'.$controle;
	}
}//Fin de if (isset($_GET['clef']))
*/
$req = $bdd->query($sql) or die('Erreurs de chargement...Réessayez plus tard, Merci ');
	
	$retour = $bdd->query($sqlcount);
	//$donnees = mysql_fetch_array($retour);
	$nb = $req->rowCount();
	$totalDesMessages = $retour->rowCount();;//$donnees['nb_msg'];

	// On calcule le nombre de pages à créer
	$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);


		if($nb == 0)
		{
			echo "Il n'y a aucun fichier correspondant à votre profil.";
		}
		else
		{
			if($nombreDePages >1)
			{
			if(isset($_GET['page'])){$page_actuelle = $_GET['page'];}else{$page_actuelle = 1;}
			$page_m1 = $page_actuelle-1;
			$page_m2 = $page_actuelle-2;
			$page_m3 = $page_actuelle-3;
			$page_m4 = $page_actuelle-4;
			$page_m5 = $page_actuelle-5;
			$page_p1 = $page_actuelle+1;
			$page_p2 = $page_actuelle+2;
			$page_p3 = $page_actuelle+3;
			$page_p4 = $page_actuelle+4;
			$page_p5 = $page_actuelle+5;
			echo '<p align="center">';
			if($page_actuelle != 1){ echo '<a onclick="fpage(1)">1</a>...';}
			if($page_m5>1){ echo '<a onclick="fpage('.$page_m5.')">' . $page_m5 . ' </a>';}
			if($page_m4>1){ echo '<a onclick="fpage('.$page_m4.')">' . $page_m4 . ' </a>';}
			if($page_m3>1){ echo '<a onclick="fpage('.$page_m3.')">' . $page_m3 . ' </a>';}
			if($page_m2>1){ echo '<a onclick="fpage('.$page_m2.')">' . $page_m2 . ' </a>';}
			if($page_m1>1){ echo '<a onclick="fpage('.$page_m1.')">' . $page_m1 . ' </a>';}
			echo '<a onclick="fpage('.$page_actuelle.')"><b><u>' . $page_actuelle . '</u></b></a>';
			if($page_p1<$nombreDePages){ echo '<a onclick="fpage('.$page_p1.')"> ' . $page_p1 . '</a>';}
			if($page_p2<$nombreDePages){ echo '<a onclick="fpage('.$page_p2.')"> ' . $page_p2 . '</a>';}
			if($page_p3<$nombreDePages){ echo '<a onclick="fpage('.$page_p3.')"> ' . $page_p3 . '</a>';}
			if($page_p4<$nombreDePages){ echo '<a onclick="fpage('.$page_p4.')"> ' . $page_p4 . '</a>';}
			if($page_p5<$nombreDePages){ echo '<a onclick="fpage('.$page_p5.')"> ' . $page_p5 . '</a>';}
			if($page_actuelle != $nombreDePages){ echo '<a onclick="fpage('.$nombreDePages.')">...' . $nombreDePages . '</a> ';}
			echo '</p>';
			}
?>
		<form method="POST" action="download/telecharger.php" name="traitement" enctype="multipart/form-data"><table align="center" border="1" bordercolor="#CCCCCC" style="border-collapse:collapse; font-size:0.8em;"><thead><tr>
		        <th>Entité<br /><a onclick="croissant('identite')"><img src="img/icon_arrow_down.gif" title="ordre croissant" /></a>&nbsp;<a onclick="decroissant('identite')"><img src="img/icon_arrow_up.gif" title="ordre décroissant" /></a></th>
		        <th>Type<br /><a onclick="croissant('type')"><img src="img/icon_arrow_down.gif" title="ordre croissant" /></a>&nbsp;<a onclick="decroissant('type')"><img src="img/icon_arrow_up.gif" title="ordre décroissant" /></a></th><th style="width:52px;">Vague<br /><a onclick="croissant('vague')"><img src="img/icon_arrow_down.gif" title="ordre croissant" /></a>&nbsp;<a onclick="decroissant('vague')"><img src="img/icon_arrow_up.gif" title="ordre décroissant" /></a></th>
          <th>Date mise en ligne<br /><a onclick="croissant('date_fichier')"><img src="img/icon_arrow_down.gif" title="ordre croissant" /></a>&nbsp;<a onclick="decroissant('date_fichier')"><img src="img/icon_arrow_up.gif" title="ordre décroissant" /></a></th><th>Voir</th><th title="tout cocher / tout décocher">S&eacute;lectionner<br /><input type="checkbox" onClick="checkAll(this.checked);" /></th><th>Date du dernier t&eacute;l&eacute;chargement<br /><a onclick="croissant('date_download')"><img src="img/icon_arrow_down.gif" title="ordre croissant" /></a>&nbsp;<a onclick="decroissant('date_download')"><img src="img/icon_arrow_up.gif" title="ordre décroissant" /></a></th></tr></thead><?php
				$couleur = true;
			while($liste = $req->fetch())
    		{
				$filename = "fiches/".$liste['fichier'];

				if (file_exists($filename))
				{

					if($couleur != false){$class = ' class="pair"';}else{$class = ' class="impair"';}
				?><tr<?php echo $class;?> title="<?php  echo "importé le ".date("d/m/Y", filemtime($filename));?>">

                <td style="text-align:left;"><?php echo $tab_entite[$liste['identite']]; ?></td><td><?php echo $liste['type']; ?></td>

                <td><?php echo $liste['vague']; ?></td><td><?php echo date('d/m/Y',strtotime($liste['date_fichier'])); ?></td><td><a href="<?php echo $filename; ?>" title="cliquez pour télécharger" onclick="majdownload(<?php echo $liste['id_fichier'];?>)"><img src="img/clip_pasteafter.gif" /></a></td><td align="center"><input type="checkbox" name="case[]" value="<?php echo $liste['fichier']; ?>"></td><td><span id="<?php echo $liste['id_fichier'];?>"><?php if(!empty($liste['date_download'])) echo date('d/m/Y',strtotime($liste['date_download'])); ?></span></td></tr><?php
				if($couleur == false){$couleur = true;}else{$couleur = false;}

				}
				else
				{
				?><tr>
                <td style="text-align:left;"><?php echo $tab_entite[$liste['identite']]; ?></td><td><?php echo $liste['type']; ?></td>

                <td><?php echo $liste['vague']; ?></td><td><b>fichier non charg&eacute;</b></td><td>&nbsp;</td><td>&nbsp;</td><td><?php if(!empty($liste['date_download'])) echo date('d/m/Y',strtotime($liste['date_download'])); ?></td></tr><?php
				}

			}//Fin du while
			?>
            <tr><td colspan="5">&nbsp;</td><td><input type="image" src="img/zip.gif" title="Créer un fichier zip" value="Zip" onclick="majdownload2()"></td><td>&nbsp;</td></tr></table><?php echo "nombre: ".$totalDesMessages; ?>
            </form>
<?php
		}//Fin de if($nombre == 0)
//echo "<font color='white'>".$sqlcount."</font><br />";
?>