<?php 
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=normandie_31_03;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$par_type=isset($_POST['type'])?$_POST['type']:"is_axe";


function theme_select($par_type){
   global $bdd;
   $request="SELECT distinct libelle_theme FROM said_datamap WHERE ".$par_type."=1";
   $retour=$bdd->query($request);
   $result='';
   while ( $data=$retour->fetch(PDO::FETCH_ASSOC)) {

     $result.='<optgroup label="'.$data["libelle_theme"].'"></optgroup>';
     $result.=general_theme($par_type,$data["libelle_theme"]);

   }
   

   return $result;

}

function general_theme($par_type,$par_theme){
    global $bdd;
    $par_theme='"'.$par_theme.'"';
    $request="SELECT distinct sous_theme FROM said_datamap WHERE ".$par_type."=1 AND libelle_theme=".$par_theme."";
    $retour=$bdd->query($request);
    $result='';
    
    while ( $data=$retour->fetch(PDO::FETCH_ASSOC)) {
    $result.='<option value="'.$data["sous_theme"].'">-----;'.$data["sous_theme"].'</option>';
 
    }
    return $result;
 }





 ?>





<form method="post">

<select name="type" onchange="this.form.submit()" >
  <option value="is_axe" <?php if (isset($_POST['type']) && $_POST['type']=="is_axe") { echo "selected";} ?>>Axe</option>
  <option value="is_gare" <?php if (isset($_POST['type']) && $_POST['type']=="is_gare") { echo "selected";} ?> >Gare</option>
  <option value="is_ligne" <?php if (isset($_POST['type']) && $_POST['type']=="is_ligne") { echo "selected";} ?> >ligne</option>
</select>


	<legend>Theme</legend>

<select name="theme" onchange="Themer(this.value);" id="theme" size="8">
 <?php echo theme_select($par_type) ?>

</select>

</form>

<div id="chart1" style="display:inline-block;"></div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
		categ1 = JSON.parse(file("trouver_libelle.php?variable="+variable1[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data1 = JSON.parse(file("trouver_libelle.php?valeur="+variable1[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
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
		categ2 = JSON.parse(file("trouver_libelle.php?variable="+variable2[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data2 = JSON.parse(file("trouver_libelle.php?valeur="+variable2[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
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
		categ3 = JSON.parse(file("trouver_libelle.php?variable="+variable3[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data3 = JSON.parse(file("trouver_libelle.php?valeur="+variable3[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
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
		categ4 = JSON.parse(file("trouver_libelle.php?variable="+variable4[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data4 = JSON.parse(file("trouver_libelle.php?valeur="+variable4[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
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
		categ5 = JSON.parse(file("trouver_libelle.php?variable="+variable5[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data5 = JSON.parse(file("trouver_libelle.php?valeur="+variable5[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
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
		categ6 = JSON.parse(file("trouver_libelle.php?variable="+variable6[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data6 = JSON.parse(file("trouver_libelle.php?valeur="+variable6[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
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
		categ7 = JSON.parse(file("trouver_libelle.php?variable="+variable7[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data7 = JSON.parse(file("trouver_libelle.php?valeur="+variable7[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
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
		categ8 = JSON.parse(file("trouver_libelle.php?variable="+variable8[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
		data8 = JSON.parse(file("trouver_libelle.php?valeur="+variable8[theme]+"&axe="+axe+"&frequence="+frequence+"&typevague="+typevague));
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




