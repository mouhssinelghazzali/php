
<html>

<head>
    <title>FusionCharts | USA Map</title>
    <!-- FusionCharts Library -->
    <script type="text/javascript" src="//cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script type="text/javascript" src="//cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
    <!--
        <script type="text/javascript" src="//cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.gammel.js"></script>
        <script type="text/javascript" src="//cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.zune.js"></script>
        <script type="text/javascript" src="//cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.carbon.js"></script>
        <script type="text/javascript" src="//cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.ocean.js"></script>
    -->
    <script type="text/javascript">
        FusionCharts && FusionCharts.ready(function () {
            var trans = document.getElementById("controllers").getElementsByTagName("input");
            for (var i=0, len=trans.length; i<len; i++) {                
                if (trans[i].type == "radio"){
                    trans[i].onchange = function() {
                        changeChartType(this.value);
                    };
                }
            }
        });
        
        function changeChartType(chartType) {
            for (var k in FusionCharts.items) {
                if (FusionCharts.items.hasOwnProperty(k)) {
                    FusionCharts.items[k].chartType(chartType);
                }
            }
        };
    </script>
</head>

<body>

<?php 

include("./includes/fusioncharts2.php");
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=normandie_31_03;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$par_type=isset($_POST['type'])?$_POST['type']:"is_axe";
$theme=isset($_POST['theme'])?$_POST['theme']:"ssss";
var_dump($theme);







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
 }					$ident_eric ='';
					 	$vague=isset($_POST['vague'])?$_POST['vague']:"2019V1";
					if ($_POST["type"] == "is_axe")
					{
						$ident_eric =  "Axe";
					}
					else if($_POST["type"] == "is_gare")
					{
						$ident_eric =  "Q1";

					}
					else{
						$ident_eric =  "REGION";

					}
						 $sql  = $bdd->query("select  question,ident_eric,vague from t_graphique,said_datamap where vague='".$vague."' and ident_eric REGEXP '^$ident_eric' and sous_theme='".$theme."'");
					

						 $dbdata  = array();
						 while ($row = $sql->fetchall()) {
								 $dbdata [] = $row;

					
						 }
						 echo json_encode($dbdata );

 ?>





<form method="post">


<fieldset><legend>Vague</legend>
<select name="vague" id="vague" onchange="this.form.submit()">
<option value="2019V1" <?php if (isset($_POST['vague']) && $_POST['vague']=="2019V1") { echo "selected";} ?>>2019V1</option>
<option value="2019V2" <?php if (isset($_POST['vague']) && $_POST['vague']=="2019V2") { echo "selected";} ?>>2019V2</option></select>
</fieldset>



<select name="type" onchange="this.form.submit()" >
  <option value="is_axe" <?php if (isset($_POST['type']) && $_POST['type']=="is_axe") { echo "selected";} ?>>Axe</option>
  <option value="is_gare" <?php if (isset($_POST['type']) && $_POST['type']=="is_gare") { echo "selected";} ?> >Gare</option>
  <option value="is_ligne" <?php if (isset($_POST['type']) && $_POST['type']=="is_ligne") { echo "selected";} ?> >ligne</option>
</select>


	<legend>Theme</legend>

<select name="theme" onchange="this.form.submit()" onchange="Themer(this.value);" id="theme" size="8" >
 <?php echo theme_select($par_type) ?>

</select>

</form>





        <?php
                $mapData = "{
                    \"chart\":
                    {  
                        \"caption\": \"Countries With Most Oil Reserves [2017-18]\",
                        \"subcaption\": \"In MMbbl = One Million barrels\",
                        \"xaxisname\": \"Country\",
                        \"yaxisname\": \"Reserves (MMbbl)\",
                        \"numbersuffix\": \"K\",
                        \"theme\": \"fusion\"
                        },
                        \"data\": [{
                        \"label\": \"Venezuela\",
                        \"value\": \"290\"
                    }, {
                        \"label\": \"Saudi\",
                        \"value\": \"260\"
                    }, {
                        \"label\": \"Canada\",
                        \"value\": \"180\"
                    }, {
                        \"label\": \"Iran\",
                        \"value\": \"140\"
                    }, {
                        \"label\": \"Russia\",
                        \"value\": \"115\"
                    }, {
                        \"label\": \"UAE\",
                        \"value\": \"100\"
                    }, {
                        \"label\": \"US\",
                        \"value\": \"30\"
                    }, {
                        \"label\": \"China\",
                        \"value\": \"30\"
                    }]
                  }";

      // chart object
      $Chart = new FusionCharts("column2d", "chart-1" , "600", "350", "chartContainer", "json", $mapData);

      // Render the chart
      $Chart->render();

?>

        <h3>Dynamic Chart Type Change</h3>
        <div align="center">
            <label style="padding: 0px 5px !important;">Select The Chart Type</label>
        </div>
        <br/>
        <div id="controllers" align="center" style="font-family:'Helvetica Neue', Arial; font-size: 14px;">
          
            <label style="padding: 0px 5px !important;">
                    <input type="radio" name="div-size" value="bar2d"/>Bar 2D
            </label>
        </div>
        <br/>
        <br/>
        <br/>
        <div style="width: 100%; display: block;" align="center">
            <div id="chartContainer">Chart will render here!</div>
        </div>
        <br/>
        <br/>
        <a href="../index.php">Go Back</a>
    </body>

    </html>