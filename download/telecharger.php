<?php
require_once("../connection.php");


	$t_fichiers = "t_fichiers";

if(isset($_POST['case']))
{
	$zip = new ZipArchive();
	$case = $_POST['case'];
	$maintenant = date("YmdGHs");
	$date = date("Y-m-d");
	$archive = "sncf".$maintenant.".zip";//$maintenant.'.zip';
	      // On crée l'archive.
      if($zip->open($archive, ZipArchive::CREATE) == TRUE)
      {
		foreach ($case as $choix)
		{
		$zip->addFile('../fiches/'.$choix,iconv('UTF-8', 'IBM850', $choix));
		//$zip->addFile('../fiches/'.$choix);
		$reqq = $bdd->query("UPDATE`".$t_fichiers."`SET `date_download`= '".$date."' WHERE`".$t_fichiers."`.`fichier` like '".$choix."'");
		}
		$zip->close();
		// On peut ensuite, comme dans le tuto de DHKold, proposer le téléchargement.
      header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier).
      header('Content-Disposition: attachment; filename='.$archive); //Nom du fichier.
      header('Content-Length: '.filesize($archive)); //Taille du fichier.
	  header('Content-Type: application/zip');
      readfile($archive);
      }
	  else
      {
        echo 'Impossible d&#039;ouvrir &quot;Zip.zip&quot;';
    // Traitement des erreurs avec un switch(), par exemple.
      }
}
else
{
?><p>Vous n'avez pas s&eacute;lectionn&eacute; de fichiers</p><span style="background-color:#EFF4F4; padding:3px; font-weight:bold;"><a href="javascript:history.back()"><img src="../images/icon_arrow_left.png" border="0"/>&nbsp;Retour</a></span><p>&nbsp;</p><?php
	}
?>