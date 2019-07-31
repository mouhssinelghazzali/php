<style>
tr:nth-child(even) {background: #CCC;}
fieldset {
    display: inline-block;
}

</style>
<script type="text/javascript">
if (document.body)
{
var larg = (document.body.clientWidth)-30;
var haut = (document.body.clientHeight)-30;
}
else
{
var larg = (window.innerWidth)-30;
var haut = (window.innerHeight)-30;
}

if(larg<600)
{
	larg = larg +20;
}
else if(larg>1200)
{
	larg = larg - 100;
}

function getRandom() {
  return Math.random()*100;
}
function getFaible() {
  return Math.random()*50;
}
var larg = "400";
var longueur = "230";
var couleur_1 = "#024a82";
var couleur_2 = "#1E90FF";
var couleur_3 = "#00BFFF";
var couleur_4 = "#CCCCCC";
var couleur_5 = "#999999";
var couleur_6 = "#444444";
var data0 = [{"label":"Tout à fait satisfait","value":getRandom(),"color":couleur_2},{"label":"Plutôt","value":getRandom(),"color":couleur_3},{"label":"Plutôt pas","value":getFaible(),"color":couleur_4},{"label":"Pas du tout satisfait","value":getFaible(),"color":couleur_6}];
var data1 = [{"label":"Tout à fait satisfait","value":getRandom(),"color":couleur_2},{"label":"Plutôt","value":getRandom(),"color":couleur_3},{"label":"Plutôt pas","value":getFaible(),"color":couleur_4},{"label":"Pas du tout satisfait","value":getFaible(),"color":couleur_6}];
var data2 = [{"label":"Ambassadeurs","value":getRandom(),"color":couleur_1},{"label":"Passifs","value":getFaible(),"color":couleur_5},{"label":"D\u00e9tracteurs","value":getFaible(),"color":couleur_6}];
var data3 = [{"label":"Tout à fait satisfait","value":getRandom(),"color":couleur_2},{"label":"Plutôt","value":getRandom(),"color":couleur_3},{"label":"Plutôt pas","value":getFaible(),"color":couleur_4},{"label":"Pas du tout satisfait","value":getFaible(),"color":couleur_6}];
var data4 = [{"label":"Tr\u00e8s bas","value":getFaible(),"color":couleur_1},{"label":"Bas","value":getRandom(),"color":couleur_2},{"label":"Moyen","value":getRandom(),"color":couleur_3},{"label":"Elev\u00e9","value":getRandom(),"color":couleur_5},{"label":"Tr\u00e8s Elev\u00e9","value":getFaible(),"color":couleur_6}];
var data5 = [{"label":"Tout à fait satisfait","value":getRandom(),"color":couleur_2},{"label":"Plutôt","value":getRandom(),"color":couleur_3},{"label":"Plutôt pas","value":getFaible(),"color":couleur_4},{"label":"Pas du tout satisfait","value":getFaible(),"color":couleur_6}];

var soustitre = "";
var vague= "2016 v1";
var subcaption = soustitre + " (" + vague + ")";

var theme = 1;
var theme1 = ["Satisfaction générale de la réalisation du service","Raisons de choix du point de vente","Satisfaction globale de l'achat du titre en gare","Satisfaction globale de l'environnement et la propreté de la gare","La qualité des informations fournies par le personnel en gare","Satisfaction du confort à bord "];
var theme2 = ["Arrêts desservis sur cette ligne","Mode de prise de rendez-vous","Clarté et qualité des informations données par l'agent au guichet ","Tranquillité dans la gare","Amabilité du personnel dans le hall ou sur les quais de la gare","Facilité à trouver une place assise à bord (ferré) ","Nom du forfait"];
var theme3 = ["Qualité de conduite","Perception des informations disposées dans le point de vente","Temps d'attente (au guichet ou au distributeur automatique) ","Confort des lieux d'attente dans la gare ","","Propreté du TER/car","Nom de la promotion"];
var theme4 = ["Correspondances avec les autres modes (TER/TGV, transports urbains…) ","","Amabilité de l'agent au guichet ","Espaces pour attendre sur les quais de la gare","","Audibilité des messages sonores à bord ",""];

var tabtype = ["doughnut2d","Pie2d","Bar2d","Column2d"];

</script>
<h1>SCORE</h1>

<fieldset><legend>Vague</legend>
<select name="vague" onchange="Vaguer(this.value);Recharger();"><option value="%"></option>
<option value="2016 v1">2016 v1</option><option value="2017 v2">2017 v2</option></select>
</fieldset>

<fieldset><legend>THÉMATIQUES</legend>
<select name="theme" onchange="Themer(this.value);" id="theme">
<option value="0">Satisfaction sur la réalisation du service de la ligne TER</option>
<option value="2">Satisfaction de l'achat du titre en gare</option>
<option value="3">Satisfaction de l'environnement et la propreté de la gare de montée</option>
<option value="4">Satisfaction vis-à-vis du personnel en gare de montée</option>

<option value="5">Satisfaction du confort à bord du train/car TER</option>
</select>
</fieldset>

<fieldset><legend>Type d'établissement</legend>
<select id="reseau" name="reseau" onchange="Soustitrer(this.value);">
<option value="ECT">Etablissement Commercial Train (ECT)</option>
<option value="TNC" >TechniCentre (TNC)</option>
<option value="Escale / Vente" >Etablissement Escale / Vente</option>
</select>
</fieldset>

<fieldset><legend>Etablissement</legend>
<select id="region" name="region" onchange="Soustitrer(this.value);">
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
<select id="agence" name="agence" onchange="Soustitrer(this.value);">
<option>UO Prg</option>
<option>UO Paz</option>
<option>UO Orléanais / Berry</option>
<option>UO Chartres</option>
<option>UO Tours</option>
</select>
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


<script type="text/javascript" src="fusioncharts/fusioncharts.js"></script>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.widgets.js"></script>
<script type="text/javascript" src="fusioncharts/themes/fusioncharts.theme.fint.js"></script>
<script type="text/javascript">
function Donut(type, chart, caption, subcaption, datable)
{
	{
    var fusioncharts = new FusionCharts({
   "type":type,
   "renderAt":chart,
   "width":"400px",
   "height":"400px",
      
   "dataFormat":"json",
   "dataSource":{
      "data":datable,
      "chart":{
         "caption":caption,
		 "subcaption":subcaption,
		 "bgColor": "EEEEEE,FFFFFF,EEEEEE",
        "bgratio": "10,80,10",
        "bgAlpha": "90,90,90",
        "use3DLighting": "1",
		"showPercentValues":"1",
         "captionAlignment":"left",
         "canvasbgColor":"#FFFEFE",
         "valueFontColor":"#000000",
         "useRoundEdges":"0",
         "outCnvBaseFontColor":"#000000",
         "showValues":"1",
         "valueFontSize":"15",
         "decimals":"0",
         "yAxisMaxValue":"100",
         "showToolTip":"0",
         "placeValuesInside":"0",
         "showLegend":"1",
         "legendBgColor":"#FFFFFF",
         "legendBgAlpha":"100",
         "legendPosition":"BOTTOM",
         "legendIconScale":"1",
         "rotateValues":"0",
         "exportEnabled":"0",
         "alignCaptionWithCanvas":"0",
         "exportAction":"download",
         "exportFormats":"PNG=Enregistrer en PNG|JPG= Enregistrer en JPEG|PDF=Enregistrer en PDF",
         "exportFileName":"National 2017 v2",
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

FusionCharts.ready(
	Donut(tabtype[1],"chart1","Satisfaction générale de la réalisation du service", subcaption,data1),
	Donut(tabtype[0],"chart2","Arrêts desservis sur cette ligne", subcaption,data5),
	Donut(tabtype[1],"chart3", "Qualité de conduite (routier) ", subcaption,data3),
	Donut(tabtype[1],"chart4","Correspondances avec les autres modes (TER/TGV, transports urbains…)", subcaption,data4)
);

function Soustitrer(valeur)
{
	soustitre = valeur;
	subcaption = valeur + " (" + vague + ")";
	Recharger();
}

function Vaguer(valeur)
{
	vague = valeur;
	subcaption = soustitre + " (" + vague + ")";
	Recharger();
}


function Themer(valeur)
{
	theme = valeur;
	Recharger();
}

function Recharger()
{
	if(theme==0)
		{
			Donut(tabtype[1],"chart1",theme1[theme], subcaption, data1);
		}
		else
		{
			Donut(tabtype[2],"chart1",theme1[theme], subcaption, data1);
		}
	
	if(theme != 0)
	{
		document.getElementById("chart2").style.display = "inline-block";
		if(theme!="")
			{		Donut(tabtype[2],"chart2",theme2[theme], subcaption, data3);}
		else if(theme2[theme] == "") {document.getElementById("chart2").style.display = "none";}

	}
	else
	{
		if(theme==0)
		{
			document.getElementById("chart2").style.display = "inline-block";
			Donut(tabtype[0],"chart2",theme2[theme], subcaption, data1);
		}
		else if(theme2[theme] != "")
		{
			document.getElementById("chart2").style.display = "inline-block";
			Donut(tabtype[2],"chart2",theme2[theme], subcaption, data1);
		}
			
	}
	
	if(theme3[theme] != "")
	{
		document.getElementById("chart3").style.display = "inline-block";
		if(theme==0)
			{
				Donut(tabtype[1],"chart3",theme3[theme], subcaption, data3);
			}
			else
			{
				Donut(tabtype[2],"chart3",theme3[theme], subcaption, data5);
				}
	}
	else
	{
		document.getElementById("chart3").style.display = "none";
		//alert("chart 4 vide");
	}
	
	
	if(theme4[theme] != "")
	{
		document.getElementById("chart4").style.display = "inline-block";
		if(theme==0)
			{
				Donut(tabtype[1],"chart4",theme4[theme], subcaption, data4);
			}
			else
			{
				Donut(tabtype[2],"chart4",theme4[theme], subcaption, data0);
			}
	}
	else
	{
		document.getElementById("chart4").style.display = "none";
		//alert("chart 4 vide");
	}
}

</script>
</div>