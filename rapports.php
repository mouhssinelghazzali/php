<script type="text/javascript">
var global_niveau = <?php echo $_SESSION['type'];?>;
var colonne = "fichier"; // Colonne pour le tri
var triage = "ASC"; // Tri croissant
var recherchetype = "vaguetype";
var global_type = "";
<?php
if(isset($_SESSION['type']))
{
	if($_SESSION['type']==0)
	{
		echo 'var global_niv3 = "%";var global_niv4 = "%";';
	}
	elseif($_SESSION['type']==4)
	{
		echo 'var global_niv3 = "";var global_niv4 = "'.$_SESSION['identite'].'";';
	}
	else
	{
		echo 'var global_niv3 = "'.$_SESSION['identite'].'";var global_niv4 = "%";';
	}
	
}
$tab_entite = array();
$sqlstructure = "SELECT identite, auteur FROM t_user GROUP BY identite";
$reqstructure = $bdd->query($sqlstructure);
while($list_struc = $reqstructure->fetch())
{
	$tab_entite[$list_struc['identite']] = $list_struc['auteur'];
}
$reqstructure->closeCursor();
/*
if(isset($_SESSION['type']))
{
	$sqlmax = "SELECT MAX(vague) as vagmax FROM t_fichiers WHERE identite='".$_SESSION['identite']."'";

	$reqmax = $bdd->query($sqlmax);
	$max = $reqmax->fetch();
	$vague=$max["vagmax"];
	echo 'var global_vague = "'.$vague.'";';
	$reqmax->closeCursor();
}
*/
?>
var global_vague = "";
var global_annee = global_vague.substring(0,4);
var global_identite = "<?php echo $_SESSION['identite'];?>";


function fselection(){
	tablecase.length = 0; // On vide le tablea pour éviter de garder en mémoire les cases cochés servant au zip !
	var bonus = "";
	//var motcherche = document.formulairechercher.mot_a_chercher.value;
	var motcherche = document.getElementById("motcherche").value;
		
	if(global_type != "")
	{
		bonus += "&type=" + global_type;
	}
	bonus += "&identite=" + global_identite;
		if(recherchetype == "clef")
		{
		document.getElementById("tableau").innerHTML=file("afficher_rapports.php?clef="+motcherche+"&colonne="+colonne+"&triage="+triage);
		}
		else
		{
			//alert("afficher_rapports.php?vague="+global_vague+bonus+"&colonne="+colonne+"&triage="+triage);
			document.getElementById("tableau").innerHTML=file("afficher_rapports.php?vague="+global_vague+bonus+"&colonne="+colonne+"&triage="+triage);
		
		}
}
function fvague(valeur){
global_vague = valeur;
global_annee = valeur.substring(0,4); // Mis à jour de la date.
fselection();
}

function fidentite(valeur)
{
	global_identite = valeur;
	fselection();
}

function ftype(valeur)
{
	global_type = valeur;
	fselection();
}

function fpage(page){
	var motcherche = document.getElementById("motcherche");
	var bonus = "";
	if(global_type != "")
	{
		bonus += "&type=" + global_type;
	}
	bonus += "&identite=" + global_identite;
	
	if(recherchetype == "clef")
	{document.getElementById("tableau").innerHTML=file("afficher_rapports.php?clef="+motcherche+"&page="+page+"&colonne="+colonne+"&triage="+triage);
	}
	else{
	document.getElementById("tableau").innerHTML=file("afficher_rapports.php?vague="+global_vague+"&page="+page+bonus+"&colonne="+colonne+"&triage="+triage);
	}
}
function chercher(){
	recherchetype = "clef";
	//var motcherche = document.formulairechercher.mot_a_chercher.value;
	var motcherche = document.getElementById("motcherche").value;
	document.getElementById("tableau").innerHTML=file("afficher_rapports.php?clef="+motcherche);
}
function croissant(valeur){
colonne = valeur;
triage = "ASC";
fselection();
}
function decroissant(valeur){
colonne = valeur;
triage = "DESC";
fselection();
}
</script>
<h3 style="line-height:0px;">Rapports</h3><br />
<form method="POST" name="formulairebanque">
<?php
$identite = $_SESSION['identite'];
//Liste déroulante de la vague
	if($_SESSION['type'] ==0)
	{
		$sqlvague ="SELECT t_fichiers.vague FROM t_fichiers GROUP BY vague";
	}
	else
	{
		$sqlvague = "SELECT t_fichiers.vague FROM t_fichiers INNER JOIN t_structure ON t_fichiers.identite=t_structure.num_niv4 WHERE t_structure.num_niv3='".$identite."' GROUP BY vague";

	}
	$req = $bdd->query($sqlvague);

			?><div style="display:inline-block;text-align: center;margin: 5px;">Vague<br /><select name="vague" onChange='fvague(this.value)'><option value='%'></option><?php
	while ($liste = $req->fetch())//while($liste = mysql_fetch_assoc($req))
    {
		echo "<option value='".rawurlencode($liste["vague"])."'>".$liste["vague"]."</option>";
	}
			?></select></div><?php

$req->closeCursor();


if($_SESSION['type']<4)
{
	$entites = array();
	$sqlidentite = "SELECT num_niv4, lib_niv4 FROM t_structure WHERE t_structure.num_niv3 = '".$_SESSION['identite']."' GROUP BY lib_niv4 ORDER BY ordre";
	$requeteidentite = $bdd->query($sqlidentite);
	
	while($listeidentite = $requeteidentite->fetch())
	{
		$entites[$listeidentite['num_niv4']] = $listeidentite['lib_niv4'];
	}
	$requeteidentite->closeCursor();

	if(count($entites)>0)
	{
?>
        <div style="display:inline-block;text-align: center;margin: 5px;">Entité&nbsp;<br />
        <select name="identite" onChange='fidentite(this.value)'>
        <option value="<?php echo $_SESSION['identite']; ?>"></option>
		<?php
        foreach($entites as $key=>$value)
        {
            echo "<option value='".$key."'";
            if($key==$identite) {echo "selected";}
            echo ">".$value."</option>";
        }
        ?>
        </select></div>
		<?php
	} // if count 0
	else
	{
	?>
    <input type="hidden" name="identite" value="<?php echo $identite;?>" />	
    <?php 
	}

} // if session 4


//Liste déroulante des types de maquettes
if($_SESSION['type'] == 0)
{
	$filtre = "";
}
else
{
	$filtre = " WHERE identite='".$_SESSION['identite']."'";
}
	$reqtype= $bdd->query("SELECT type FROM t_fichiers ".$filtre." GROUP BY type");

	$nbtype = $reqtype->rowCount();
	if($nbtype != 0)
	{
		?>
		
		<div style="display:inline-block;text-align: center;margin: 5px;">Type<br /><select name="type" onChange="ftype(this.value)">
        <option></option>
		<?php
		while($listetype = $reqtype->fetch())
		{
			echo "<option value='".$listetype["type"]."'>".$listetype["type"]."</option>";
		}
		?></select></div>
		<div style="display:inline-block;text-align: center;margin: 5px;">
		<button>Réinitialisation</button>
		</div>
		<?php
	}
	$reqtype->closeCursor();
?>

</form>
<table style="display:none; vertical-align: baseline;"><tr><td colspan="3">&nbsp;</td></tr><form method="POST" name="formulairechercher">&nbsp;<tr><td>&nbsp;&nbsp;&nbsp;<a href="index.php?id=<?php echo $_GET['id'];?>" style="border: solid #999 1px; background-color:#CCC; padding:5px;"><b>Reinitialiser</b></a>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;Rechercher</td><td><input type="text" name="mot_a_chercher" onkeyup="chercher()" id="motcherche" /><a onclick="chercher()"><img src="img/btn-submit-search.png" /></a></td></tr></form></table>
<?php
$affichage = false;
$nombreDeMessagesParPage = 40;	
if (isset($_GET['page']))
{
        $page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse
}
else // La variable n'existe pas, c'est la première fois qu'on charge la page
{
        $page = 1; // On se met sur la page 1 (par défaut)
}
// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;

/*if($_SESSION['type'] == 0)
{
$sql = 'SELECT id_fichier, fichier, identite, type, vague, date_download, date_fichier FROM t_fichiers WHERE identite="national" ORDER BY fichier LIMIT '. $premierMessageAafficher.', '.$nombreDeMessagesParPage;
$affichage = true;
$sqlcount = 'SELECT id_fichier FROM t_fichiers WHERE identite="national"';
}
else
{*/
$sql = 'SELECT * FROM (SELECT id_fichier, fichier, identite, type, vague, date_download, date_fichier FROM t_fichiers INNER JOIN t_structure ON t_fichiers.identite = t_structure.num_niv4 WHERE num_niv3 like "'.$identite.'" AND SUBSTRING(vague, 1, 4) = annee GROUP BY fichier UNION
SELECT id_fichier, fichier, identite, type, vague, date_download, date_fichier FROM t_fichiers INNER JOIN t_structure ON t_structure.num_niv3 = t_fichiers.identite WHERE t_structure.num_niv3 like "'.$identite.'" AND SUBSTRING(vague, 1, 4) = annee GROUP BY fichier) AS tmp ORDER BY fichier LIMIT '. $premierMessageAafficher.', '.$nombreDeMessagesParPage;

$affichage = true;
$sqlcount = 'SELECT id_fichier FROM (SELECT id_fichier, fichier, identite, type, vague, date_download, date_fichier FROM t_fichiers INNER JOIN t_structure ON t_fichiers.identite = t_structure.num_niv4 WHERE num_niv3 like "'.$identite.'" AND SUBSTRING(vague, 1, 4) = annee GROUP BY fichier UNION
SELECT id_fichier, fichier, identite, type, vague, date_download, date_fichier FROM t_fichiers INNER JOIN t_structure ON t_structure.num_niv3 = t_fichiers.identite WHERE t_structure.num_niv3 like "'.$identite.'" AND SUBSTRING(vague, 1, 4) = annee GROUP BY fichier) AS tmp';
//}


//echo $sql;
if($affichage)
{
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
		}else
		{
			?><div id="tableau">
            <?php
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
                    <th>Type<br /><a onclick="croissant('type')"><img src="img/icon_arrow_down.gif" title="ordre croissant" /></a>&nbsp;<a onclick="decroissant('type')"><img src="img/icon_arrow_up.gif" title="ordre décroissant" /></a></th><th>Vague<br /><a onclick="croissant('vague')"><img src="img/icon_arrow_down.gif" title="ordre croissant" /></a>&nbsp;<a onclick="decroissant('vague')"><img src="img/icon_arrow_up.gif" title="ordre décroissant" /></a></th>
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

                <td><?php echo $liste['vague']; ?></td><td><?php echo date('d/m/Y',strtotime($liste['date_fichier'])); ?></td><td><a href="<?php echo $filename; ?>" title="cliquez pour télécharger" onclick="majdownload(<?php echo $liste['id_fichier'];?>)"><img src="img/clip_pasteafter.gif" /></a></td><td align="center"><input type="checkbox" name="case[]" value="<?php echo $liste['fichier']; ?>" onclick="cocher(<?php echo $liste['id_fichier'];?>)"></td><td><span id="<?php echo $liste['id_fichier'];?>"><?php if(!empty($liste['date_download'])) echo date('d/m/Y',strtotime($liste['date_download'])); ?></span></td></tr><?php
				if($couleur == false){$couleur = true;}else{$couleur = false;}
				}
				else
				{
					?>
					<td style="text-align:left;"><?php echo $tab_entite[$liste['identite']]; ?></td><td><?php echo $liste['type']; ?></td>

				<td><?php echo $liste['vague']; ?></td><td><b>fichier non chargé</b></td><td>&nbsp;</td><td>&nbsp;</td><td><?php if(!empty($liste['date_download'])) echo $liste['date_download']; ?></td></tr><?php
				}
			}
			?>
            <tr><td colspan="5">&nbsp;</td><td><input type="image" src="img/zip.gif" title="Créer un fichier zip" value="Zip" onclick="majdownload2()"></td><td>&nbsp;</td></tr></table>
			<?php echo "nombre: ".$totalDesMessages; ?>
            </form></div><?php
		}
}//if affichage
else
{
	echo "<p>Vous n'avez pas les droits d'accès</p>";
}
?>