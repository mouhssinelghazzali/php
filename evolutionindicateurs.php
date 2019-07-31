<style>
tr:nth-child(even) {background: #CCC;}
fieldset {
    display: inline-block;
	vertical-align:top;
}
.survol:hover
{
	cursor:pointer;
	background-color: #024a82;
	color:white;
}
</style>
<script type="text/javascript">

function getRandom() {
  return Math.random()*100;
}
function getFaible() {
  return Math.random()*50;
}
var largeur = "400";
var hauteur = "400";

<?php

// Construction de la table des autorisations pour l'utilisateur
if(isset($_GET['identite']))
{	$identite = $_GET['identite'];}
else
{	$identite = $_SESSION['identite'];}

?>

var typevague = "v";
var frequence = "TOTAL";

<?php if( $identite=="national") {$axe = "Global_1";}
elseif(strpos($identite, 'caen')){$axe = "total_uo_caen";}
elseif(strpos($identite, 'rouen')){$axe = "total_uo_rouen";}
elseif(strpos($identite, 'sotteville')){$axe = "total_uo_rouen";}
elseif(strpos($identite, 'psl')){$axe = "total_psl";}
elseif(strpos($identite, 'stlazare')){$axe = "total_psl";}
elseif($identite == 'unite_gares'){$axe = "";}
else {$axe = "Global_1";}?>

var axe = "<?php echo $axe;?>";


var theme =  'gare';

var theme1 = [];
var theme2 = [];
var theme3 = [];
var theme4 = [];
var theme5 =[];
var theme6 = [];
var theme7 = [];
var theme8 = [];

var variable1 = [];
var variable2 = [];
var variable3 = [];
var variable4 = [];
var variable5 =[];
var variable6 = [];
var variable7 = [];
var variable8 = [];

var graph1 = [];
var graph2 = [];
var graph3 = [];
var graph4 = [];
var graph5 =[];
var graph6 = [];
var graph7 = [];
var graph8 = [];

<?php


$sqldroits = "SELECT * FROM t_user WHERE identite='".$identite."'";
$reqdroits = $bdd->query($sqldroits);
$listedroits = $reqdroits->fetch();
//extract($listedroits);
//echo $Q1;
$reqdroits->closeCursor();

// Construction de la table des critères pour définir le libéllé, la variable et le chartype
$sqlcritere = "SELECT libelle, crit_fille, variable, chartype FROM i_critere WHERE crit_fille IS NOT NULL AND variable IS NOT NULL ORDER BY crit_fille, ordre";
$reqcritere = $bdd->query($sqlcritere);
$i = 1;
$fille = "";
while($listecritfille = $reqcritere->fetch())
{
	if($fille != $listecritfille['crit_fille'])
	{
		$i=1;
		$fille = $listecritfille['crit_fille'];
		$variable = $listecritfille['variable'];
		if($listedroits[$variable])
		{
			//echo "console.log('".$variable." = ".$listedroits[$variable]."');";
			echo "theme".$i.'["'.$fille.'"]="'.$listecritfille['libelle'].'";';
			echo "variable".$i.'["'.$fille.'"]="'.$listecritfille['variable'].'";';
			echo "graph".$i.'["'.$fille.'"]="'.$listecritfille['chartype'].'";';
		}
	}
	else
	{
		$i++;
		$fille = $listecritfille['crit_fille'];
		$variable = $listecritfille['variable'];
		if($listedroits[$variable])
		{
			//echo "console.log('".$variable." = ".$listedroits[$variable]."');";
			echo "theme".$i.'["'.$fille.'"]="'.$listecritfille['libelle'].'";';
			echo "variable".$i.'["'.$fille.'"]="'.$listecritfille['variable'].'";';
			echo "graph".$i.'["'.$fille.'"]="'.$listecritfille['chartype'].'";';
		}
	}	
}
$reqcritere->closeCursor();



?>

/*
theme1["gare"] = "Par quel moyen de transport êtes-vous arrivé(e) dans votre gare de montée ?";
theme2["gare"] = "Vous avez pu trouver une place de stationnement…";
theme3["gare"] = "Vous avez pu venir en transports collectifs";
*/

var tabtype = ["doughnut2d","Pie2d","Bar2d","Column2d"];

function addcritere(nordre,nlibelle,ncrit_mere,ncrit_fille,nvariable,nchart) {
    this.ordre = nordre;
    this.libelle = nlibelle;
    this.crit_mere = ncrit_mere;
	this.crit_fille = ncrit_fille;
	this.variable = nvariable;
	this.chart = nchart;
  }
<?php
/*
$sql = 'SELECT * FROM i_critere';
$reqcrit = $bdd->query($sql);
echo "tcritere = new Array(200);";
while($listecrit = $reqcrit->fetch())
{
	echo "tcritere[".$listecrit["ordre"]."] = new addcritere(\"".$listecrit["ordre"]."\",\"".$listecrit["libelle"]."\",\"".$listecrit["crit_mere"]."\",\"".$listecrit["crit_fille"]."\",\"".$listecrit["variable"]."\",\"".$listecrit["chartype"]."\");";
}
$reqcrit->closeCursor();
*/
	?>  
</script>
<h1>EVOLUTION par indicateurs</h1>

<?php
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

<fieldset><legend>Type de vague</legend>
<select name="typevague" onchange="Typevaguer(this.value);Recharger();">
<option value="v">trimestre</option>
<option value="s">semestriel</option>
<option value="a">annuel</option>
</select>
</fieldset>



<fieldset><legend>Thème</legend>
<form action="index.php" method="get">
<input type="hidden" name="id" value="14" />
<select name="identite" onchange="this.form.submit();">
<option value="<?php if( $_SESSION['identite']=="national") {echo "national";}else{echo $_SESSION['identite'];}?>">Sélectionner un thème</option>
<?php
foreach($entites as $key=>$value)
{
	echo "<option value='".$key."'";
	if($key==$identite) {echo "selected";}
	echo ">".$value."</option>";
}
?>
</select>
</form>
</fieldset>
<?php
	} // if count 0

} // if session 4
?>

<fieldset><legend>Axe / Ligne / Gare</legend>
<select name="axe" onchange="Axer(this.value);Recharger();">
 <option value="<?php if( $_SESSION['identite']=="national") {echo "Global_1";}else{echo $_SESSION['identite'];}?>">Sélectionner un thème</option>
<?php
	$sqlaxe = "SELECT id_axes, lib_axes FROM i_axes INNER JOIN t_user ON t_user.identite=i_axes.id_possesseur WHERE i_axes.id_possesseur = '".$identite."' GROUP BY lib_axes";

$requeteaxe = $bdd->query($sqlaxe);

while($listeaxe = $requeteaxe->fetch())
{
	echo "<option value='".$listeaxe['id_axes']."'";
	if($listeaxe['id_axes'] == $axe){echo " selected";}
	echo " >".$listeaxe['lib_axes']."</option>";
}
$requeteaxe->closeCursor();
?>
</select>
</fieldset>

<fieldset><legend>Fréquence</legend>
<select name="frequence" onchange="Frequencer(this.value);Recharger();">
<option></option>
<?php
$sqlfrequence = "SELECT frequence FROM i_graphique GROUP BY frequence";
$requetefrequence = $bdd->query($sqlfrequence);
while($listefrequence = $requetefrequence->fetch())
{
	echo "<option";
	if($listefrequence['frequence']=='TOTAL') {echo " selected";}
	echo ">".$listefrequence['frequence']."</option>";

}
$requetefrequence->closeCursor();
?>
</select>
</fieldset>

<fieldset><legend>THÉMATIQUES</legend>
<select name="theme" onchange="Themer(this.value);" id="theme" size="8">

<?php
$sqlgroup="SELECT libelle, crit_mere, chartype FROM i_critere WHERE ordre<10 ORDER BY ordre";
$requetegroup = $bdd->query($sqlgroup);
$text_options = "";
while($listegroup = $requetegroup->fetch())
{
	$crit_mere = $listegroup['crit_mere'];
	$sqlfiltre = "SELECT variable FROM i_critere WHERE ordre>100 AND crit_fille='".$crit_mere."' ORDER BY ordre";
	$requetefiltre = $bdd->query($sqlfiltre);
	$affiche_item = false;

	while($listefiltre = $requetefiltre->fetch())
	{
		if($listedroits[$listefiltre['variable']]){$affiche_item = true;}
	}
	$requetefiltre->closeCursor();

	
		if($affiche_item)
			{
			$text_options .= "<option value='".$listegroup['crit_mere']."' style='font-weight:bold; ' class='survol' >&#8594;     ".$listegroup['libelle']."</option>";
			}
			
	
	$textitems_options = "";
	$sqlssgroup = "SELECT libelle, crit_mere FROM i_critere WHERE ordre<100 AND crit_fille='".$listegroup['crit_mere']."' ORDER BY ordre";
	$requetessgroup = $bdd->query($sqlssgroup);
	while($listessgroup = $requetessgroup->fetch())
	{
		$critss_mere = $listessgroup['crit_mere'];
		$sqlssfiltre = "SELECT variable FROM i_critere WHERE ordre>100 AND crit_fille='".$critss_mere."' ORDER BY ordre";
		//echo "<option>".$sqlssfiltre."</option>";
		$requetessfiltre = $bdd->query($sqlssfiltre);
		$affichess_item = false;
		while($listessfiltre = $requetessfiltre->fetch())
		{
			if($listedroits[$listessfiltre['variable']]){$affichess_item = true;}//else{echo "<option>".$listessfiltre['variable']." = ".$listedroits[$listessfiltre['variable']]."</option>";}
		}
		$requetessfiltre->closeCursor();
		
		if($affichess_item)
		{
		// Ajout de l'item
			$textitems_options .= "<option value='".$critss_mere."' class='survol' >&#8594; ".$listessgroup['libelle']."</option>";
		}
	}
	$requetessgroup->closeCursor();
	
	if(($affichess_item) && (empty($listegroup['chartype'])))
		{
			$text_options .= "<optgroup label='".$listegroup['libelle']."'>";
		}
	$text_options .= $textitems_options;
	
	if(($affichess_item) && (empty($listegroup['chartype'])))
	{
		$text_options .= "</optgroup>";
	}
}
$requetegroup->closeCursor();
echo $text_options;
?>

</select>
</fieldset>

<fieldset><legend>Dimension du graphique</legend>
<label for="id_largeur" style="display:inline;vertical-align: 20%;">largeur</label>
<input type="number" name="id_largeur" id="id_largeur" min="350" max="1920" step="50" value="400" maxlength="4" onChange='flargeur(this.value)' style="width:50px;" >
<label for="id_hauteur" style="display:inline;vertical-align: 20%;">hauteur</label>
<input type="number" name="id_hauteur" id="id_hauteur" min="350" max="1080" step="50" value="400" maxlength="4" onChange='fhauteur(this.value)' style="width:50px;" >
<br>
<button><a href="index.php?id=14">Réinitialisation </a></button>
</fieldset>

<div style="margin:auto;text-align: center;">

<!-- AngularGauge - Configuring the Gauge inner and outer radius

Attributes:
   
    # gaugeOuterRadius
    # gaugeInnerRadius
    
-->
<div id="chart1" style="display:inline-block;"></div>
<div id="chart2" style="display:inline-block;"></div>
<div id="chart3" style="display:inline-block;"></div>
<div id="chart4" style="display:inline-block;"></div>
<div id="chart5" style="display:inline-block;"></div>
<div id="chart6" style="display:inline-block;"></div>
<div id="chart7" style="display:inline-block;"></div>
<div id="chart8" style="display:inline-block;"></div>

<script type="text/javascript" src="fusioncharts/fusioncharts.js"></script>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.widgets.js"></script>
<script type="text/javascript" src="fusioncharts/themes/fusioncharts.theme.fint.js"></script>
<script type="text/javascript">
function flargeur(valeur)
{
	largeur = valeur;
	Recharger();
}

function fhauteur(valeur)
{
	hauteur = valeur;
	Recharger();
}


function Donut(type, chart, caption, subcaption, datable, categ)
{
	var showlabel = 1;
	if(type=="pie2d"){showlabel = 0;}else if(type=="doughnut2d"){showlabel = 0;}
	{
    var fusioncharts = new FusionCharts({
   "type":type,
   "renderAt":chart,
   "width":largeur+"px",
   "height":hauteur+"px",
      
   "dataFormat":"json",
   "dataSource":{
      //"data":datable,
	  "categories": categ,
	   "dataset":datable,
      "chart":{
         "caption":caption,
		 "subcaption":subcaption,
		 "showLabels":showlabel,
		 "numberSuffix": "%",
		 "bgColor": "EEEEEE,FFFFFF,EEEEEE",
         "bgratio": "10,80,10",
         "bgAlpha": "90,90,90",
         "use3DLighting": "1",
		 "showPercentValues":"0",
         "captionAlignment":"left",
         "canvasbgColor":"#FFFEFE",
         "valueFontColor":"#000000",
         "useRoundEdges":"0",
         "outCnvBaseFontColor":"#000000",
         "showValues":"1",
         "valueFontSize":"15",
         "decimals":"0",
         "yAxisMaxValue":"100",
		 "xAxisMaxValue":"100",
         "showToolTip":"1",
		 "plotToolText": "$label $dataValue",
         "placeValuesInside":"0",
         "showLegend":"1",
         "legendBgColor":"#FFFFFF",
         "legendBgAlpha":"100",
         "legendPosition":"BOTTOM",
         "legendIconScale":"1",
         "rotateValues":"0",
         "exportEnabled":"1",
         "alignCaptionWithCanvas":"0",
         "theme":"fint",
         "maxLabelWidthPercent":"50",
         "labelDisplay":"auto",
         "slantLabels":"1",
         "labelFontSize":"10"
      }
   }
}
);
    fusioncharts.render();
}
}

/*
FusionCharts.ready(
	Donut(tabtype[1],"chart1","Satisfaction générale de la réalisation du service", subcaption,data1),
	Donut(tabtype[0],"chart2","Arrêts desservis sur cette ligne", subcaption,data5),
	Donut(tabtype[1],"chart3", "Qualité de conduite (routier) ", subcaption,data3),
	Donut(tabtype[1],"chart4","Correspondances avec les autres modes (TER/TGV, transports urbains…)", subcaption,data4),
	Donut(tabtype[1],"chart5","Correspondances avec les autres modes (TER/TGV, transports urbains…)", subcaption,data4),
	Donut(tabtype[1],"chart6","Correspondances avec les autres modes (TER/TGV, transports urbains…)", subcaption,data4)
);
*/


function Axer(valeur)
{
	axe = valeur;
	Recharger();
}

function Typevaguer(valeur)
{
	typevague = valeur;
	Recharger();
}


function Frequencer(valeur)
{
	frequence = valeur;
	Recharger();
}

function Themer(valeur)
{
	theme = valeur;
	Recharger();
}

function Recharger()
{
		if(axe!="")
		{
	if(theme1[theme] != undefined)
	{
		document.getElementById("chart1").style.display = "inline-block";
		categ1 = JSON.parse(file("trouver_indicateurs.php?variable="+variable1[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data1 = JSON.parse(file("trouver_indicateurs.php?valeur="+variable1[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		var subcaption1 = "";
		graphique1 = graph1[theme];

		Donut(graphique1,"chart1",theme1[theme], subcaption1, data1, categ1);
	}
	else
	{
		document.getElementById("chart1").style.display = "none";
	}
	
	if(theme2[theme] != undefined)
	{
		document.getElementById("chart2").style.display = "inline-block";
		categ2 = JSON.parse(file("trouver_indicateurs.php?variable="+variable2[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data2 = JSON.parse(file("trouver_indicateurs.php?valeur="+variable2[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		var subcaption2 = "";
		graphique2 = graph2[theme];

		Donut(graphique2,"chart2",theme2[theme], subcaption2, data2, categ2);
	}
	else
	{
		document.getElementById("chart2").style.display = "none";
	}
	
	if(theme3[theme] != undefined)
	{
		document.getElementById("chart3").style.display = "inline-block";
		categ3 = JSON.parse(file("trouver_indicateurs.php?variable="+variable3[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data3 = JSON.parse(file("trouver_indicateurs.php?valeur="+variable3[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		var subcaption3 = "";
		graphique3 = graph3[theme];

		Donut(graphique3,"chart3",theme3[theme], subcaption3, data3, categ3);
	}
	else
	{
		document.getElementById("chart3").style.display = "none";
	}
	
	if(theme4[theme] != undefined)
	{
		document.getElementById("chart4").style.display = "inline-block";
		categ4 = JSON.parse(file("trouver_indicateurs.php?variable="+variable4[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data4 = JSON.parse(file("trouver_indicateurs.php?valeur="+variable4[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		var subcaption4 = "";
		graphique4 = graph4[theme];

		Donut(graphique4,"chart4",theme4[theme], subcaption4, data4, categ4);
	}
	else
	{
		document.getElementById("chart4").style.display = "none";
	}
	
	if(theme5[theme] != undefined)
	{
		document.getElementById("chart5").style.display = "inline-block";
		categ5 = JSON.parse(file("trouver_indicateurs.php?variable="+variable5[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data5 = JSON.parse(file("trouver_indicateurs.php?valeur="+variable5[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		var subcaption5 = "";
		graphique5 = graph5[theme];

		Donut(graphique5,"chart5",theme5[theme], subcaption5, data5, categ5);
	}
	else
	{
		document.getElementById("chart5").style.display = "none";
	}
	
	if(theme6[theme] != undefined)
	{
		document.getElementById("chart6").style.display = "inline-block";
		categ6 = JSON.parse(file("trouver_indicateurs.php?variable="+variable6[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data6 = JSON.parse(file("trouver_indicateurs.php?valeur="+variable6[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		var subcaption6 = "";
		graphique6 = graph6[theme];

		Donut(graphique6,"chart6",theme6[theme], subcaption6, data6, categ6);
	}
	else
	{
		document.getElementById("chart6").style.display = "none";
	}
	
	if(theme7[theme] != undefined)
	{
		document.getElementById("chart7").style.display = "inline-block";
		categ7 = JSON.parse(file("trouver_indicateurs.php?variable="+variable7[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data7 = JSON.parse(file("trouver_indicateurs.php?valeur="+variable7[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		var subcaption7 = "";
		graphique7 = graph7[theme];

		Donut(graphique7,"chart7",theme7[theme], subcaption7, data7, categ7);
	}
	else
	{
		document.getElementById("chart7").style.display = "none";
	}
	
	if(theme8[theme] != undefined)
	{
		document.getElementById("chart8").style.display = "inline-block";
		categ8 = JSON.parse(file("trouver_indicateurs.php?variable="+variable8[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data8 = JSON.parse(file("trouver_indicateurs.php?valeur="+variable8[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		var subcaption8 = "";
		graphique8 = graph8[theme];

		Donut(graphique8,"chart8",theme8[theme], subcaption8, data8, categ8);
	}
	else
	{
		document.getElementById("chart8").style.display = "none";
	}
	
	
		}// FIN de AXE
}
<?php if( $_SESSION['identite']=="national") {echo 'Themer("satisfaction");';}?>

</script>
</div>