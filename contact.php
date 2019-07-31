<?php
//session_start();
	if (isset($_POST['commentaire']))
	{
		include("Includes/function_mail.php");
		$commentaire = str_replace("'", "&#39;", nl2br($_POST['commentaire']));
		if(empty($_POST['nom'])){ $nom=$_SESSION['auteur'];} else{$nom = str_replace("'", "''", $_POST['nom']);}
		if(empty($_POST['email'])){ $mail=$_SESSION['mail'];} else{$mail = $_POST['email'];}
		
		$to = 'ternormandie@mv2-enquetes.com'; // 
		$sujet = str_replace("'", "''", $_POST['objet']);
		$msg = 'Ce mail a été envoyé par '.$mail;
		$msg .= "<p>".$commentaire."</p>";
		$msg = utf8_decode($msg);
		
		if(envoyermail($to, $sujet, $msg, $nom, $mail,'ana.green@mv2group.com', 'sa.maach@tpphoning.com'))
		{
			echo "envoyé";
		}
		else
		{
			echo "echec de l'envoi: à ".$to." _ ".$sujet." _ ".$msg." _ de ".$nom." _ <".$mail.">" ;
		}
		
		//echo'<br><br><span style="background-color:#EFF4F4; padding:3px; font-weight:bold;"><a href="index.php?id=1">&nbsp;Retour à l\'accueil</a></span><br />';
	}
	else
	{
		?>
<script src="http://mv2-enquetes.com/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
function filepost()
{
		var data = CKEDITOR.instances.commentaire.getData();
		//console.log(data);
		var parametres = [];
		var args = Array.prototype.slice.call(arguments);
		for(var indice in args)
		{
			var id = args[indice];
			var valeur = document.getElementById(id).value;
			//console.log(id+"="+valeur);
			parametres.push(id+"="+valeur);
		}
		parametres.push("commentaire="+data);
		//console.log(parametres.join('&'));

	if(window.XMLHttpRequest) // FIREFOX
	xhr = new XMLHttpRequest();
	else if(window.ActiveXObject) // IE
	xhr = new ActiveXObject("Microsoft.XMLHTTP");
	else
	return(false);
	var reponse = xhr.responseText;
	xhr.open("POST", "contact.php", false);
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	xhr.send(parametres.join('&')); // On transmet les paramètres
	if(xhr.readyState == 4) { alert('Mail envoyé');document.location.href="index.php?id=6";  return(xhr.responseText);}
	else { return(false);}

}
</script>
<h1>CONTACT</h1>

<form action="contact.php" method="post" name="formulaire" id="formulaire" style="background-color:#F0F0F0;padding:5px;box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);margin: 1em;">
<div style="display:inline-block;vertical-align: top;  text-align:center;width: 100%;">
<LABEL for="email" style="color:#515151; font-weight:bold;">Votre adresse e-mail&nbsp;<span class="obligatoire">*</span>&nbsp;</LABEL></div>
<div style="display:inline-block;vertical-align: top; width:99%;">
<INPUT id="email" tabIndex="1" name="email" value="" type="text" style="width:100%;" required="required">
</div>
<br />
<div style="display:inline-block;vertical-align: top;  text-align:center;width: 100%;">
<LABEL for="objet" style="color:#515151; font-weight:bold;">L'objet de votre message&nbsp;</LABEL>
</div><div style="display:inline-block;vertical-align: top;width:99%;">
<INPUT id="objet" tabIndex="2" name="objet" value="" type="text" style="width:100%;" required="required">
</div>
<br />
<div style="display:inline-block;vertical-align: top; padding-right:5px; text-align:center;width: 100%;">
<label for="commentaire" style="color:#515151; font-weight:bold;">Votre message&nbsp;<span class="obligatoire">*</span>&nbsp;</label>
</div><div style="display:inline-block;vertical-align: top;width:99%;">
<TEXTAREA tabindex="3" style="width:100%;" rows="6" id="commentaire" name="commentaire" required="required"></TEXTAREA>
</div>
<div style="margin:auto; text-align:center;">
<input type="button" value="Envoyer" onclick="filepost('email','objet')" />
</div>
<br />
</form>
<script type="text/javascript">
CKEDITOR.replace( 'commentaire' );
</script>
<?php }?>