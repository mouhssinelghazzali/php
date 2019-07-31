<script type="text/javascript"src="fusioncharts/fusioncharts.js"></script>
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
var region = "";

function fregion(valeur)
{
region = valeur;
if(region=='PARIS')
{
document.getElementById('agence').innerHTML = '<option>Sud Francilien</option><option>Massif Central</option>';
}
else if(region=='RHIN')
{
document.getElementById('agence').innerHTML = '<option>Champagne Lorraine</option><option>Franche Comté</option>';
}
else if(region=='RHONE')
{
document.getElementById('agence').innerHTML = '<option>Sud Bourgogne Ain</option><option>Portes de Lyon</option>';
}
else
{
document.getElementById('agence').innerHTML = '<option>Sud Francilien</option><option>Massif Central</option><option>Champagne Lorraine</option><option>Franche Comté</option><option>Sud Bourgogne Ain</option><option>Portes de Lyon</option>';
}
}
</script>
<style>
.liste li 
{
display:block;
}
fieldset{display: inline-block;}
</style>
<h1>Classement</h1>
<div style="margin:auto;text-align: center;">
<div id="filtres"style="margin:auto;text-align: center;">

<fieldset><legend>Type d'établissement</legend>
<select id="reseau"name="reseau"onchange="setReseau(this.value);">
<option value="ECT">Etablissement Commercial Train (ECT)</option>
<option value="TNC" >TechniCentre (TNC)</option>
<option value="Escale / Vente" >Etablissement Escale / Vente</option>
</select>
</fieldset>

<fieldset><legend>Etablissement</legend>
<select id="region"name="region"onchange="setCritere(this.value);">
<option>ECT Paris Atlantique Centre</option>
<option>Etablissement Régional Centre (ERV CENTRE)</option>
</select>
</fieldset>

</div>
<div id="chart-container">Chargement...</div>

<fieldset>
<legend>Largeur</legend>
<input id="largeur" type="number" min="400" max="1800" value="1000" style="width:50px;" step="50" onchange="setWidth(this.value)" />
</fieldset>

<fieldset>
<legend>Hauteur</legend>
<input type="number"min="400" max="800" value="450" style="width:50px;" step="50" onchange="setHeight(this.value)" />
</fieldset>
<script type="text/javascript">
var reseau = "Tous les réseaux : ";
var largeur = "1000";
var longueur = "450";
var test = "Tous";
var datatest = [];
datatest['Tous']=[{"label": "Etablissement Escale / Vente","value": "85"}, {"label": "Etablissement Commercial Train (ECT)","value": "83"}, {"label": "TechniCentre (TNC)","value": "67"}];

datatest['ECT']=[{"label": "EAS","value": "96"}, {"label": "ECT Nantes","value": "95"},{"label": "ECT Paris Atlantique Centre","value": "94"}, {"label": "ECT Tours","value": "73"}, {"label": "ECT Dijon","value": "60"}];
datatest['TNC']=[{"label": "TNC Paris Austerlitz","value": "90"}, {"label": "TNC Montrouge","value": "72"}, {"label": "TNC Montrouge (LABO)","value": "70"}, {"label": "TNC Pays de la Loire","value": "69"},{"label": "TNC Compagnie du Blanc Argent","value": "53"},{"label": "TNC Saint Pierre des Corps","value": "50"} ];
datatest['Escale / Vente']=[{"label": "Etablissement Régional Centre (ERV CENTRE)","value": "98"}, {"label": "Etablissement infrastructure Circulation Limousin (EIC Limousin)","value": "95"}, {"label": "Compagnie du Blanc Argent","value": "87"}, {"label": "Etablissement infrastructure Circulation PRG (EIC PRG)","value": "78"}, {"label": "Etablissement infrastructure Circulation Centre (EIC Centre)","value": "69"} ];

datatest['ECT Paris Atlantique Centre']=[{"label": "UO Prg","value": "99"}, {"label": "UO Paz","value": "80"}];
datatest['Etablissement Régional Centre (ERV CENTRE)']=[{"label": "UO Orléanais / Berry","value": "77"}, {"label": "UO Chartres","value": "84"}, {"label": "UO Tours","value": "55"}];


function setReseau(valeur)
{
reseau = valeur + " : ";
deploychart();
}

function setWidth(valeur)
{
largeur = valeur;
deploychart();
}

function setHeight(valeur)
{
longueur = valeur;
deploychart();
}

function setReseau(valeur)
{
test = valeur;
deploychart();
}



function setCritere(valeur)
{
test = valeur;
deploychart();
}

function deploychart() {
    var revenueChart = new FusionCharts({
        type: 'column2d',
        renderAt: 'chart-container',
        width: largeur,
        height: longueur,
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "caption": "Performance Globale",
                "subCaption": reseau + test,
                "paletteColors": "#999999",
                "bgColor": "#ffffff",
                "borderAlpha": "20",
                "canvasBorderAlpha": "0",
                "usePlotGradientColor": "0",
                "plotBorderAlpha": "10",
                "placevaluesInside": "1",
                "rotatevalues": "0",
                "valueFontColor": "#ffffff",                
                "showXAxisLine": "1",
                "xAxisLineColor": "#999999",
                "divlineColor": "#999999",               
                "divLineIsDashed": "1",
                "showAlternateHGridColor": "0",
                "subcaptionFontBold": "0",
                "subcaptionFontSize": "14",
                "labelDisplay": "auto",
                "slantLabels":"1",
"yAxisMaxValue": "100"
            },            
            "data": datatest[test],
            "trendlines": [
                {
                    "line": [
                        {
                            "startvalue": "75",
                            "color": "#1aaf5d",
                            "valueOnRight": "1",
                            "displayvalue": "MOYENNE{br}NATIONALE"
                        }
                    ]
                }
            ]
        }
    }).render();
}
FusionCharts.ready(
deploychart()
);
document.getElementById("largeur").value = larg;
setWidth(larg);

</script>
</div>