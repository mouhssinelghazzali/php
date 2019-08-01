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
						 $sql  = $bdd->query("select ident_eric,vague from t_graphique where vague='".$vague."' and ident_eric REGEXP '^$ident_eric'");
					

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

<select name="theme" onchange="Themer(this.value);" id="theme" size="8">
 <?php echo theme_select($par_type) ?>

</select>

</form>


