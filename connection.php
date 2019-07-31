<?php
try
{
	$bdd = new PDO('mysql:host=mv2-enquetes.com;dbname=normandie_19;charset=utf8', 'normandie19', 'N0rmanmeurt');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

/*
if ($db>0)
echo "Connexion établie avec succés";
else
echo "Connexion non établie";
*/
?>