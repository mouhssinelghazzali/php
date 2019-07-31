<style>
tr:nth-child(even) {background: #CCC;}
</style>
<?php

// MOIS
$tabmois = array();
$sql = "SELECT MONTH(datemysql) AS MOIS FROM `stif_avancement` GROUP BY MOIS";
$selection = $bdd->query($sql);
while($liste = $selection->fetch())
{
	array_push($tabmois, $liste['MOIS']);
}
$selection->closeCursor();

// SOCIETES
$tabsociete = array();
$tabdonnees = array();
if($_SESSION['type'] == 1)
{
	$sqlsociete = "SELECT societe, SUM(nb_realises) AS NBS FROM stif_avancement GROUP BY societe";
}
else
{
	$sqlsociete = "SELECT societe, SUM(nb_realises) AS NBS FROM stif_avancement WHERE societe='".$_SESSION['auteur']."' GROUP BY societe";
}
$selectsociete = $bdd->query($sqlsociete);
while($listsociete = $selectsociete->fetch())
{
	// Permet de récupérer les apostrophes
	$societe = str_replace("'", "''", $listsociete['societe']);//htmlentities($listsociete['societe'], ENT_QUOTES);
	array_push($tabsociete, $societe);
	$tabdonnees[$societe]['TOTAL'] = $listsociete['NBS'];
	// On en profite pour récolter les données
	$sqldonnees = "SELECT MONTH(datemysql) AS MOIS, SUM(nb_realises) AS NBR FROM stif_avancement WHERE societe = '".$societe."' GROUP BY MOIS";
	//echo "<br>".$sqldonnees;
	$selectdonnees = $bdd->query($sqldonnees);
	while($listdonnees = $selectdonnees->fetch())
	{
		$tabdonnees[$societe][$listdonnees['MOIS']] = $listdonnees['NBR'];
	}
	$selectdonnees->closeCursor();
}


?>
<h1>AVANCEMENT</h1>
<?php
if($_SESSION['type'] == 1)
{
	echo "<a href='excel_avancement.php'><img src='img/excel.png' alt='Excel' style='vertical-align:middle;margin: 5px 0 0 10px;' /> Exporter</a>";
}
?>
<div style="margin:auto;text-align: center; overflow: auto;">
<table>
<thead>
<tr><th><p style="text-align:right;margin:0px;">Mois</p><p style="text-align:left;margin:0px;">Société</p></th>
<?php
foreach($tabmois as $mois)
{
	echo "<th>".$mois."</th>";
}
?>
<th>total</th></tr>
</thead>
<tbody>
<?php
foreach($tabsociete as $societe)
{
	echo "<tr><td>".str_replace("''","'",$societe)."</td>";
	foreach($tabmois as $mois)
	{
		echo "<td>".$tabdonnees[$societe][$mois]."</td>";
	}
	echo "<td>".$tabdonnees[$societe]['TOTAL']."</td>";
	echo "</tr>";	
}
?>
</tbody>
</table>
</div>