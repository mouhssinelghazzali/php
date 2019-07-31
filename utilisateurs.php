<style>
fieldset{display: inline-block;}
a:hover
{
	cursor: pointer;
}
.situation
{
	margin: auto;
	width:90%;
	border: solid 1px #25303b;
	box-shadow: 8px 8px 12px #aaa;
}
.titre
{
	background-color: #25303b;
	color: white;
	padding:5px;
	text-align:center;
	margin: 0;
	font-weight: bold;
}
.description
{
	padding:5px;
}
.reponse
{
font-weight: bold;
}
.inacceptable
{
	background-color: #a8121a;
	color: white;
	padding:5px;
	text-align:center;
	margin: 0;
	font-weight: bold;
}
.conforme
{
	background-color: #006400;
	color: white;
	padding:5px;
	text-align:center;
	margin: 0;
	font-weight: bold;
}
.noligne
{
	border: solid 1px;
	min-width: 400px;
	width: 50%;
}
.noligne td
{
	border: 0;
}
.noligne th
{
	border: solid 1px black;
}
.overlay {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0, 0.9);
    overflow-x: hidden;
    transition: 0.5s;
}
.overlay .closebtn {
    position: absolute;
    top: 20px;
    right: 45px;
    font-size: 60px;
}
input[type="text"], input[type="password"]
{
	width: 90%;
}
</style>

<h1>Utilisateurs</h1>
<div style="margin:auto;text-align: center;">
<div id="filtres" style="margin:auto;text-align: center;">
</div>

<table>
<tr><th>Type d'établissement</th><th>Etablissement</th><th>UO</th></tr>
<tr><td rowspan="6">Etablissement Commercial Train (ECT)<br /><a href="#formulaire" onclick="Remplir('Etablissement Commercial Train (ECT)e','Franck@sncf.org','Franck','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td rowspan="2">ECT Paris Atlantique Centre<br /><a href="#formulaire" onclick="Remplir('ECT Paris Atlantique Centre','Herve@sncf.org','Hervé','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td>UO Prg<br /><a href="#formulaire" onclick="Remplir('UO Prg','Sylvie@sncf.org','Sylvie','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td></tr>
<tr><td>UO Paz<br /><a href="#formulaire" onclick="Remplir('UO Paz','Elodie@sncf.org','&Eacute;lodie','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td></tr>
<tr><td>ECT Dijon<br /><a href="#formulaire" onclick="Remplir('ECT Dijon','Ciryl@sncf.org','Cyril','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td>ECT Nantes<br /><a href="#formulaire" onclick="Remplir('ECT Nantes','Eric@sncf.org','Eric','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td>ECT Tours<br /><a href="#formulaire" onclick="Remplir('ECT Tours','Eric@sncf.org','Eric','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td>EAS<br /><a href="#formulaire" onclick="Remplir('EAS','Eric@sncf.org','Eric','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td rowspan="6">TechniCentre (TNC)<br /><a href="#formulaire" onclick="Remplir('TechniCentre (TNC)','Herve@sncf.org','Hervé','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td>TNC Saint Pierre des Corps<br /><a href="#formulaire" onclick="Remplir('TNC Saint Pierre des Corps','Sylvie@sncf.org','Sylvie','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td>TNC Compagnie du Blanc Argent<br /><a href="#formulaire" onclick="Remplir('TNC Compagnie du Blanc Argent','Denis@sncf.org','Denis','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td>TNC Pays de la Loire<br /><a href="#formulaire" onclick="Remplir('TNC Pays de la Loire','Serge@sncf.org','Serge','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td>TNC Paris Austerlitz<br /><a href="#formulaire" onclick="Remplir('TNC Paris Austerlitz','Pierre@sncf.org','Pierre','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td>TNC Montrouge<br /><a href="#formulaire" onclick="Remplir('TNC Montrouge','Marc@sncf.org','Marc','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td>TNC Montrouge (LABO)<br /><a href="#formulaire" onclick="Remplir('TNC Montrouge (LABO)','Victor@sncf.org','Victor','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td rowspan="7">Etablissement Escale / Vente<br /><a href="#formulaire" onclick="Remplir('Etablissement Escale / Vente','Lucie@sncf.org','Lucie','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td rowspan="3">Etablissement Régional Centre (ERV CENTRE)<br /><a href="#formulaire" onclick="Remplir('Etablissement Régional Centre (ERV CENTRE)','Steeve@sncf.org','Steeve','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td>UO Orléanais / Berry<br /><a href="#formulaire" onclick="Remplir('UO Orléanais / Berry','Bernard@sncf.org','Bernard','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td></tr>
<tr><td>UO Chartres<br /><a href="#formulaire" onclick="Remplir('UO Chartres','Bernard@sncf.org','Bernard','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td></tr>
<tr><td>UO Tours<br /><a href="#formulaire" onclick="Remplir('UO Tours','Bernard@sncf.org','Bernard','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td></tr>
<tr><td>Etablissement infrastructure Circulation Centre (EIC Centre)<br /><a href="#formulaire" onclick="Remplir('Etablissement infrastructure Circulation Centre (EIC Centre)','Bernard@sncf.org','Bernard','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td>Etablissement infrastructure Circulation Limousin (EIC Limousin)<br /><a href="#formulaire" onclick="Remplir('Etablissement infrastructure Circulation Limousin (EIC Limousin)E','Bernard@sncf.org','Bernard','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td>Etablissement infrastructure Circulation PRG (EIC PRG)<br /><a href="#formulaire" onclick="Remplir('Etablissement infrastructure Circulation PRG (EIC PRG)','Bernard@sncf.org','Bernard','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
<tr><td>Compagnie du Blanc Argent<br /><a href="#formulaire" onclick="Remplir('Compagnie du Blanc Argent','Bernard@sncf.org','Bernard','test');"><img src="img/pencil.png" alt="O" /><i>Modifier</i></a></td><td></td></tr>
</table>
<br />


<form name="formulaire" id="formulaire" action="#" style="margin:auto;" class="overlay">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav();">&times;</a>
<br />
<table class="noligne">
<tr><th colspan="2">Modification</th></tr>
<tr><td><label for="identifiant">Identifiant</label></td><td><input type="text" id="identifiant" value="" disabled="disabled" /></td></tr>
<tr><td><label for="utilisateur">Utilisateur</label></td><td><input type="text" id="utilisateur" value="" /></td></tr>
<tr><td><label for="login">Login</label></td><td><input type="text" id="login" value="" /></td></tr>
<tr><td><label for="motdepasse">Mot de passe</label></td><td><input type="password" id="motdepasse" value="" /></td></tr>
<tr><td colspan="2" style="text-align:center;"><input type="button" value="Enregistrer" onclick="closeNav();" /></td></tr>
</table>
</form>
<br />

<script type="text/javascript">

function Remplir(ident,user,login,motdepasse) {
	openNav();
 document.getElementById("formulaire").reset();
 document.getElementById("identifiant").value = ident;
 document.getElementById("utilisateur").value = user;
 document.getElementById("login").value = login;
 document.getElementById("motdepasse").value = motdepasse;
}
  
function openNav() {
    document.getElementById("formulaire").style.width = "100%";
}

function closeNav() {
    document.getElementById("formulaire").style.width = "0%";
}  
</script>