<style>
tr:nth-child(even) {background: #CCC;}
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
.nonconforme
{
	background-color: #F60;
	color: white;
	padding:5px;
	text-align:center;
	margin: 0;
	font-weight: bold;
}
</style>

<h1>Remontée des situations inacceptables</h1>
<div style="margin:auto;text-align: center;">
<div id="filtres" style="margin:auto;text-align: center;">

</div>

<div class="situation">
<p class="titre" id="titre1" >Forêt de Tronçais <i>09/06/2017</i></p>
<p class="description"><u>E3-5S=1 : l'opérateur montre des signes d'agressivité</u>
<br>"Ton autoritaire dés le début : -Enlevez votre badge pour le scanner ! -Je ne peux pas ! -Je suis à 50 kms, je ne vais pas venir le faire !"</p>
<p class="reponse"><label><input name="r1" id="r1_1" value="1" type="radio" onclick="Conformer('titre1');">Conforme</label> <label><input name="r1" id="r1_3" value="3" type="radio" onclick="Nonconformer('titre1');">Non Conforme</label> <label><input name="r1" id="r1_2" value="2" type="radio" onclick="Inaccepter('titre1');">Inacceptable</label></p>
</div>
<br />
<div class="situation">
<p class="titre" id="titre2" >Forêt de Tronçais <i>09/06/2017</i></p>
<p class="description"><u>E4-7S=1 : L'opérateur se moque de votre situation, il ironise sur votre situation, il commente négativement et/ou utilise un ton autoritaire, tranchant</u>
<br>"Après m'avoir très mal reçu comme cité plus haut, il continue : - Sortez votre carte verte d'assurance !  -Posez la sur la fenêtre 5 !  -Appuyez ! Je ne vois rien !  -Il me faudra votre permis APRES ! - Il faudra payer dans les huit jours sinon 20 euros de plus !   Bref... Odieux. 
Ne s'est radouci qu' à la fin devant mon calme, je pense, et m'a dit que si le badge avait fonctionné en entrant, je pourrais voir avec APRR."</p>
<p class="reponse"><label><input name="r2" id="r2_1" value="1" type="radio" onclick="Conformer('titre2');">Conforme</label> <label><input name="r2" id="r2_3" value="3" type="radio" onclick="Nonconformer('titre2');">Non Conforme</label> <label><input name="r2" id="r2_2" value="2" type="radio" onclick="Inaccepter('titre2');">Inacceptable</label></p>
</div>
<br />
<div class="situation">
<p class="titre" id="titre3" >Langres S <i>13/06/2017</i></p>
<p class="description"><u>E3-5S=1 : l'opérateur montre des signes d'agressivité</u>
<br>""Lorsqu'il m'indique le numéro de camera pour la carte grise et que je ne la trouve pas, j'entends ""c'est pas vrai"" Plusieurs fois il me demande de bouger la carte grise devant la caméra car il ne voit pas en me disant ""si vous la mettez pas comme il faut je ne peux pas voir les indications."</p>
<p class="reponse"><label><input name="r3" id="r3_1" value="1" type="radio" onclick="Conformer('titre3');">Conforme</label> <label><input name="r3" id="r3_3" value="3" type="radio" onclick="Nonconformer('titre3');">Non Conforme</label> <label><input name="r3" id="r3_2" value="2" type="radio" onclick="Inaccepter('titre3');">Inacceptable</label></p>
</div>
<br />
<div class="situation">
<p class="titre" id="titre4" >Forêt de Tronçais <i>09/06/2017</i></p>
<p class="description"><u>E4-7S=1 : L'opérateur se moque de votre situation, il ironise sur votre situation, il commente négativement et/ou utilise un ton autoritaire, tranchant</u>
<br>"lorsqu'il me demande de montrer ma carte grise, il me demande de me dépêcher au cas où il y aurait des personnes derrière."</p>
<p class="reponse"><label><input name="r4" id="r4_1" value="1" type="radio" onclick="Conformer('titre4');">Conforme</label> <label><input name="r4" id="r4_3" value="3" type="radio" onclick="Nonconformer('titre4');">Non Conforme</label> <label><input name="r4" id="r4_2" value="2" type="radio" onclick="Inaccepter('titre4');">Inacceptable</label></p>
</div>
<br />
<div class="situation">
<p class="titre" id="titre5" >Gye <i>15/06/2017</i></p>
<p class="description"><u>E3-5S=1 : l'opérateur montre des signes d'agressivité</u>
<br>« L'opérateur n'était pas agressif  mais à sa voix on l'aurait dit blasé ou agacé. »<br />« L'opérateur me dit vous n'avez même  pas 3.3 euros sur vous...sur un ton qui semble dubitatif ».</p>
<p class="reponse"><label><input name="r5" id="r5_1" value="1" type="radio" onclick="Conformer('titre5');">Conforme</label> <label><input name="r5" id="r5_3" value="3" type="radio" onclick="Nonconformer('titre5');">Non Conforme</label> <label><input name="r5" id="r5_2" value="2" type="radio" onclick="Inaccepter('titre5');">Inacceptable</label></p>
</div>
<br />
<div class="situation">
<p class="titre" id="titre6" >Fontainebleau <i>12/06/2017</i></p>
<p class="description"><u>E3-5S=1 : l'opérateur montre des signes d'agressivité</u>
<br>"J'explique que j'ai changé de sac à main et oublié de prendre mon portefeuille et donc je n'ai aucun moyen de paiement. Elle me demande vous n'avez pas de chéquier ou un peu de monnaie. Je réponds d'une voix  guillerette ""non je n'ai pas un sou"". L'opérateur me dit "" ça ne me fait pas rire Madame"". Puis ""vous avez les papiers du véhicule au moins?"""" 
"Lorsque je dois positionner l'assurance du véhicule devant la vidéo, l'opérateur manque d'amabilité pour me demander de bouger le document."
L'opérateur est rapide pour régler le problème   L'opérateur est agacé par la situation et manque d'amabilité .</p>
<p class="reponse"><label><input name="r6" id="r6_1" value="1" type="radio" onclick="Conformer('titre6');">Conforme</label> <label><input name="r6" id="r6_3" value="3" type="radio" onclick="Nonconformer('titre6');">Non Conforme</label> <label><input name="r6" id="r6_2" value="2" type="radio" onclick="Inaccepter('titre6');">Inacceptable</label></p>
</div>
<br />
<script type="text/javascript">
function Conformer(ident) {
var x = document.getElementById(ident).classList.item(0); 
	 document.getElementById(ident).classList.remove(x);
    document.getElementById(ident).classList.add("conforme");
}

function Nonconformer(ident) {
var x = document.getElementById(ident).classList.item(0); 
	 document.getElementById(ident).classList.remove(x);
    document.getElementById(ident).classList.add("nonconforme");
}

function Inaccepter(ident) {
var x = document.getElementById(ident).classList.item(0); 
	 document.getElementById(ident).classList.remove(x);
    document.getElementById(ident).classList.add("inacceptable");
}

  
</script>