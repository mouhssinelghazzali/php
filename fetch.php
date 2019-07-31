<?php
//fetch.php

if(isset($_POST['action']))
{
 include('dbConfig.php');

 $output = '';
 $type=isset($_POST['type'])?$_POST['type']:"is_axe";
 if($_POST["action"] == 'type')
 {
 "
  SELECT distinct libelle_theme FROM said_datamap WHERE ".$type."=1
  ";
  $themement = $connect->prepare($query);
  $themement->execute(
   array(
    ':type'  => $_POST["query"]
   )
  );
  $result = $themement->fetchAll();
  $output .= '<option value="">Select theme</option>';
  foreach($result as $row)
  {
   $output .= '<option value="'.$row["theme"].'">'.$row["theme"].'</option>';
  }
 }
 if($_POST["action"] == 'theme')
 {
  $query = "
  SELECT city FROM said_datamap 
  WHERE theme = :theme
  ";
  $themement = $connect->prepare($query);
  $themement->execute(
   array(
    ':theme'  => $_POST["query"]
   )
  );
  $result = $themement->fetchAll();
  foreach($result as $row)
  {
   $output .= '<option value="'.$row["city"].'">'.$row["city"].'</option>';
  }


 }
 echo $output;
}

?>
