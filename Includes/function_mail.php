<?php  
include("class.phpmailer.php");
include("class.smtp.php");
date_default_timezone_set("Europe/Paris");

function envoyermail($to, $sujet, $msg, $auteur, $from, $copies = '', $copiescache = '')
{
	$mail             = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth   = true;
	$mail->Host       = "mv2-enquetes.com";  
	$mail->Port       = 25;             
	 
	$mail->Username   = "noreply@mv2-enquetes.com";
	$mail->Password   = "nepasrepondremv2!";        
	$mail->From       = "noreply@mv2-enquetes.com"; //adresse d'envoi correspondant au login entrée précédement
	$mail->FromName   = $auteur; // nom qui sera affiché
	$mail->Subject    = $sujet; // sujet
	$mail->AltBody    = $msg; //Body au format texte
	$mail->MsgHTML($msg);
	 
	$mail->AddReplyTo($from,$auteur);
	$mail->AddAddress($to);

	// Ajout des copies
	if($copies !='')
	{
		$pieces = explode(";", $copies);
		foreach ($pieces as $value)
		{
			$mail->addCC($value);
		}
	}
	// Ajout des copies cachées
	if($copiescache !='')
	{
		$liste = explode(";", $copiescache);
		foreach ($liste as $cache)
		{
			$mail->addBCC($cache);
		}
	}	
	$mail->IsHTML(true); // envoyer au format html, passer a false si en mode texte
	 
	if(!$mail->Send()) {
	  return false;
	} else {
	  return true;
	}
}
?>