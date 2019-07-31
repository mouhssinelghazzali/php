<style>
tr:nth-child(even) {background: #DDD;}
fieldset{display: inline-block;}
a:hover
{
cursor: pointer;
}
</style>
<script type="text/javascript">
var nomreseau = "Côté route";
var vague = '2017 v1';
var region = "National";
var agence = "";
var reseau = [];
reseau['Aquitaine']=['COUTRAS','ARVEYRES','LIBOURNE','MERIGNAC','DAX','SAINT PAUL LES DAX'];
reseau['Auvergne']=['MOULINS','CUSSET','ST POURCAIN SUR SIOULE','ESPALY SAINT MARCEL','LANGEAC','SAINT PAL DE MONS','ISSOIRE','AMBERT','COURNON D\'AUVERGNE'];
reseau['Basse-Normandie']=['VIRE','SAINT LÔ','PARIGNY'];
reseau['Bourgogne']=['BEAUNE','MACON','AUTUN','PARAY LE MONIAL'];
reseau['Franche-Comté']=['BESANCON'];
reseau['Ile-de-France']=['BRIE COMTE ROBERT','SAINT CYR L\'ECOLE','SARTROUVILLE','EVRY','VILLEPINTE'];
reseau['Languedoc-Roussillon']=['NARBONNE','ALES','BEAUCAIRE','BARJAC','SAINT GILLES','NIMES','MONTPELLIER','SERVIAN','CLERMONT L\'HERAULT','LE CRES','PERPIGNAN'];
reseau['Lorraine']=['HAUCOURT MOULAINE','METZ'];
reseau['Midi-Pyrénées']=['PAMIERS','TOULOUSE'];
reseau['Nord Pas de Calais - Picardie']=['MONTREUIL SUR MER'];
reseau['PACA']=['DIGNE','MANOSQUE','SISTERON','SISTERON Z.I.','GAP Tokoro','GAP St Jean','BRIANCON','LARAGNE MONTEGLIN','SAINT CREPIN','MARSEILLE 9ème','MARSEILLE 15ème','VITROLLES','CHATEAURENARD','FOS S/ MER','SALON DE PROVENCE','ROGNAC','TOULON','AVIGNON Centre Ville','AVIGNON Z.I.','ORANGE centre ville','ORANGE Sud','CARPENTRAS Centre ville','CARPENTRAS Z.I.','CAVAILLON','APT','BOLLENE','VALREAS'];
reseau['Poitou-Charentes']=['PARTHENAY','POITIERS','CHÂTELLERAULT'];
reseau['Rhône-Alpes']=['OYONNAX','BOURG EN BRESSE','BELLEY','AMBERIEU','RUOMS','LES VANS','ROSIERES','VALENCE','MONTELIMAR','ST PAUL LES ROMANS','SAINT EGREVE','LE FONTANIL CORNILLON','CHANAS','ST ETIENNE','FEURS','ROANNE','CHAPONOST','CHASSIEU','ST PRIEST','CHAMBÉRY','ST ALBAN LEYSSE','EPAGNY'];
reseau['National'] = ['ALES',	'AMBERIEU',	'AMBERT',	'APT',	'ARVEYRES',	'AUTUN',	'AVIGNON Centre Ville',	'AVIGNON Z.I.',	'BARJAC',	'BEAUCAIRE',	'BEAUNE',	'BELLEY','BESANCON',	'BOLLENE',	'BOURG EN BRESSE',	'BRIANCON',	'BRIE COMTE ROBERT',	'CARPENTRAS Centre ville',	'CARPENTRAS Z.I.',	'CAVAILLON',	'CHAMBÉRY',	'CHANAS',	'CHAPONOST',	'CHASSIEU',	'CHATEAURENARD',	'CHÂTELLERAULT',	'CLERMONT L\'HERAULT',	'COURNON D\'AUVERGNE',	'COUTRAS',	'CUSSET',	'DAX',	'DIGNE',	'EPAGNY',	'ESPALY SAINT MARCEL',	'EVRY',	'FEURS',	'FOS S/ MER',	'GAP St Jean',	'GAP Tokoro',	'HAUCOURT MOULAINE',	'ISSOIRE',	'LANGEAC',	'LARAGNE MONTEGLIN',	'LE CRES',	'LE FONTANIL CORNILLON',	'LES VANS',	'LIBOURNE',	'MACON',	'MANOSQUE',	'MARSEILLE 15ème',	'MARSEILLE 9ème',	'MERIGNAC',	'METZ',	'MONTELIMAR',	'MONTPELLIER',	'MONTREUIL SUR MER',	'MOULINS',	'NARBONNE',	'NIMES',	'ORANGE centre ville',	'ORANGE Sud',	'OYONNAX',	'PAMIERS',	'PARAY LE MONIAL',	'PARIGNY',	'PARTHENAY',	'PERPIGNAN',	'POITIERS',	'ROANNE',	'ROGNAC',	'ROSIERES',	'RUOMS',	'SAINT CREPIN',	'SAINT CYR L\'ECOLE',	'SAINT EGREVE',	'SAINT GILLES',	'SAINT LÔ',	'SAINT PAL DE MONS',	'SAINT PAUL LES DAX',	'SALON DE PROVENCE',	'SARTROUVILLE',	'SERVIAN',	'SISTERON',	'SISTERON Z.I.',	'ST ALBAN LEYSSE',	'ST ETIENNE',	'ST PAUL LES ROMANS',	'ST POURCAIN SUR SIOULE',	'ST PRIEST',	'TOULON',	'TOULOUSE',	'VALENCE',	'VALREAS',	'VILLEPINTE',	'VIRE',	'VITROLLES'];

function fregion(valeur)
{
region = valeur;
if(region=='Aquitaine')
{
document.getElementById('agence').innerHTML = '<option value=""></option><option>COUTRAS</option><option>ARVEYRES</option><option>LIBOURNE</option><option>MERIGNAC</option><option>DAX</option><option>SAINT PAUL LES DAX</option>';
}
else if(region=='Auvergne')
{
document.getElementById('agence').innerHTML = '<option value=""></option><option>MOULINS</option><option>CUSSET</option><option>ST POURCAIN SUR SIOULE</option><option>ESPALY SAINT MARCEL</option><option>LANGEAC</option><option>SAINT PAL DE MONS</option><option>ISSOIRE</option><option>AMBERT</option><option>COURNON D\'AUVERGNE</option>';
}
else if(region=='Basse-Normandie')
{
document.getElementById('agence').innerHTML = '<option value=""></option><option>VIRE</option><option>SAINT LÔ</option><option>PARIGNY</option>';
}
else if(region=='Bourgogne')
{
document.getElementById('agence').innerHTML = '<option value=""></option><option>BEAUNE</option><option>MACON</option><option>AUTUN</option><option>PARAY LE MONIAL</option>';
}
else if(region=='Franche-Comté')
{
document.getElementById('agence').innerHTML = '<option value=""></option><option>BESANCON</option>';
}
else if(region=='Ile-de-France')
{
document.getElementById('agence').innerHTML = '<option value=""></option><option>BRIE COMTE ROBERT</option><option>SAINT CYR L\'ECOLE</option><option>SARTROUVILLE</option><option>EVRY</option><option>VILLEPINTE</option>';
}
else if(region=='Languedoc-Roussillon')
{
document.getElementById('agence').innerHTML = '<option value=""></option><option>NARBONNE</option><option>ALES</option><option>BEAUCAIRE</option><option>BARJAC</option><option>SAINT GILLES</option><option>NIMES</option><option>MONTPELLIER</option><option>SERVIAN</option><option>CLERMONT L\'HERAULT</option><option>LE CRES</option><option>PERPIGNAN</option>';
}
else if(region=='Lorraine')
{
document.getElementById('agence').innerHTML = '<option value=""></option><option>HAUCOURT MOULAINE</option><option>METZ</option>';
}
else if(region=='Midi-Pyrénées')
{
document.getElementById('agence').innerHTML = '<option value=""></option><option>PAMIERS</option><option>TOULOUSE</option>';
}
else if(region=='Nord Pas de Calais - Picardie')
{
document.getElementById('agence').innerHTML = '<option value=""></option><option>MONTREUIL SUR MER</option>';
}
else if(region=='PACA')
{
document.getElementById('agence').innerHTML = '<option value=""></option><option>DIGNE</option><option>MANOSQUE</option><option>SISTERON</option><option>SISTERON Z.I.</option><option>GAP Tokoro</option><option>GAP St Jean</option><option>BRIANCON</option><option>LARAGNE MONTEGLIN</option><option>SAINT CREPIN</option><option>MARSEILLE 9ème</option><option>MARSEILLE 15ème</option><option>VITROLLES</option><option>CHATEAURENARD</option><option>FOS S/ MER</option><option>SALON DE PROVENCE</option><option>ROGNAC</option><option>TOULON</option><option>AVIGNON Centre Ville</option><option>AVIGNON Z.I.</option><option>ORANGE centre ville</option><option>ORANGE Sud</option><option>CARPENTRAS Centre ville</option><option>CARPENTRAS Z.I.</option><option>CAVAILLON</option><option>APT</option><option>BOLLENE</option><option>VALREAS</option>';
}
else if(region=='Poitou-Charentes')
{
document.getElementById('agence').innerHTML = '<option value=""></option><option>PARTHENAY</option><option>POITIERS</option><option>CHÂTELLERAULT</option>';
}
else if(region=='Rhône-Alpes')
{
document.getElementById('agence').innerHTML = '<option>OYONNAX</option><option>BOURG EN BRESSE</option><option>BELLEY</option><option>AMBERIEU</option><option>RUOMS</option><option>LES VANS</option><option>ROSIERES</option><option>VALENCE</option><option>MONTELIMAR</option><option>ST PAUL LES ROMANS</option><option>SAINT EGREVE</option><option>LE FONTANIL CORNILLON</option><option>CHANAS</option><option>ST ETIENNE</option><option>FEURS</option><option>ROANNE</option><option>CHAPONOST</option><option>CHASSIEU</option><option>ST PRIEST</option><option>CHAMBÉRY</option><option>ST ALBAN LEYSSE</option><option>EPAGNY</option>';
}
else
{
document.getElementById('agence').innerHTML = '<option></option><option>Sud Francilien</option><option>Massif Central</option><option>Champagne Lorraine</option><option>Franche Comté</option><option>Sud Bourgogne Ain</option><option>Portes de Lyon</option>';
}
Action();
}

function fagence(valeur)
{
agence = valeur;
document.getElementById('contenu').innerHTML = '<tr><td>' + vague + '</td><td>' + nomreseau + '</td><td>' + valeur + '</td><td><a href="#"><img src="img/pdf.png" title="Démo non disponible"></a></td></tr>';
}

function fvague(valeur)
{
vague = valeur;
Action();
}

function setReseau(valeur)
{
nomreseau = valeur;
Action();
}

function Action()
{
	// Affichage du tableau
	var i;
	var text = "";
	var table = [];
	table = reseau[region];
	console.log(region);
	for (i = 0; i < table.length; i++)
	{
		text += '<tr><td>' + vague + '</td><td>' + nomreseau + '</td><td>' + table[i] + '</td><td><a href="#"><img src="img/pdf.png" title="Démo non disponible"></a></td></tr>';
	}
	document.getElementById('contenu').innerHTML = text;
}
</script>
<h1>Rapports</h1>
<div style="margin:auto;text-align: center;">
<div id="filtres" style="margin:auto;text-align: center;">

<fieldset><legend>Vague</legend>
<select id="vague" name="vague" onchange="">
<option>2017 v1</option>
<option>2017 v2</option>
</select>
</fieldset>

<fieldset><legend>Type d'établissement</legend>
<select id="reseau"name="reseau"onchange="">
<option value="ECT">Etablissement Commercial Train (ECT)</option>
<option value="TNC" >TechniCentre (TNC)</option>
<option value="Escale" >Etablissement Escale / Vente</option>
</select>
</fieldset>

<fieldset><legend>Etablissement</legend>
<select id="region" name="region" onchange="">
<option value="National">National</option>
<option>ECT Paris Atlantique Centre</option>
<option>ECT Dijon</option>
<option>ECT Nantes</option>
<option>ECT Tours</option>
<option>EAS</option>
<option>TNC Saint Pierre des Corps</option>
<option>TNC Compagnie du Blanc Argent</option>
<option>TNC Pays de la Loire</option>
<option>TNC Paris Austerlitz</option>
<option>TNC Montrouge</option>
<option>TNC Montrouge (LABO)</option>
<option>Etablissement Régional Centre (ERV CENTRE)</option>
<option>Etablissement infrastructure Circulation Centre (EIC Centre)</option>
<option>Etablissement infrastructure Circulation Limousin (EIC Limousin)</option>
<option>Etablissement infrastructure Circulation PRG (EIC PRG)</option>
<option>Compagnie du Blanc Argent</option>
</select>
</fieldset>

<fieldset>
<legend>UO</legend>
<select id="agence" name="agence" onchange="">
<option>UO Prg</option>
<option>UO Paz</option>
<option>UO Orléanais / Berry</option>
<option>UO Chartres</option>
<option>UO Tours</option>
</select>
</fieldset>
</div>

<div id="tableau" style="margin:auto;text-align: center; overflow: auto;">

<table style="margin-top:10px; margin-bottom:10px;">
<thead>
<tr>
<th>Vague</th>
<th>Type</th>
<th>Etablissement ou UO</th>
<th>Fichier</th>
</tr>
</thead>
<tbody id="contenu">
<tr><td>2017 v1</td><td>ECT</td><td>UO Prg</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>ECT</td><td>UO Prg</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>ECT</td><td>ECT Paris Atlantique Centre</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>ECT</td><td>ECT Dijon</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>ECT</td><td>ECT Nantes</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>ECT</td><td>ECT Tours</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>ECT</td><td>EAS</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>TNC</td><td>TNC Saint Pierre des Corps</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>TNC</td><td>TNC Compagnie du Blanc Argent</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>TNC</td><td>TNC Pays de la Loire</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>TNC</td><td>TNC Paris Austerlitz</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>TNC</td><td>TNC Montrouge</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>TNC</td><td>TNC Montrouge (LABO)</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>Etablissement Escale / Vente</td><td>UO Orléanais / Berry</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>Etablissement Escale / Vente</td><td>UO Chartres</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>Etablissement Escale / Vente</td><td>UO Tours</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>Etablissement Escale / Vente</td><td>Etablissement Régional Centre (ERV CENTRE)</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>Etablissement Escale / Vente</td><td>Etablissement infrastructure Circulation Centre (EIC Centre)</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>Etablissement Escale / Vente</td><td>Etablissement infrastructure Circulation Limousin (EIC Limousin)</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>Etablissement Escale / Vente</td><td>Etablissement infrastructure Circulation PRG (EIC PRG)</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
<tr><td>2017 v1</td><td>Etablissement Escale / Vente</td><td>Compagnie du Blanc Argent</td><td><a href="#"><img src="img/pdf.png" title="La maquette n'est pas disponible, ceci est une démo avant tout"></a></td></tr>
</tbody>
</table>


</div>
</div>