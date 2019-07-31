<?php
// Inialize session
session_start();
// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['username'])) {
header('Location: login.php');
}
ini_set('memory_limit', '256M');
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

/** Include PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("MV2")
							 ->setLastModifiedBy("MV2")
							 ->setTitle("Optile")
							 ->setSubject("Avancement")
							 ->setDescription("Table de donnees pour l'avancement du terrain");


// TODO : Afficher les colonnes et extraire toutes les données de la table tdd_flash
$sheet = $objPHPExcel->getActiveSheet(); // On active d'abord le sheet
// Rename worksheet
$sheet->setTitle('Avancement');

/*
$objPHPExcel->getActiveSheet()->getStyle('1:1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('1:1')->getFill()->getStartColor()->setARGB('FFEEECE1');
$objPHPExcel->getActiveSheet()->getStyle('1:1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
$objPHPExcel->getActiveSheet()->getStyle('1:1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
*/

// Affichage des colonnes
require_once("connection.php");

// Récupération des données
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
$sqlsociete = "SELECT societe, SUM(nb_realises) AS NBS FROM stif_avancement GROUP BY societe";
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


// Remplissage des en-têtes de colonnes :
$sheet->setCellValueByColumnAndRow(0,1, "Société \ Mois");

for($i=1; $i<count($tabmois)+1;$i++)
{
	$valeur = $tabmois[$i-1];
	$sheet->setCellValueByColumnAndRow($i,1, $valeur);
}


$k = count($tabmois)+1;
$sheet->setCellValueByColumnAndRow($k,1, "total");


// Remplissage des données :
$ligne = 2;
foreach($tabsociete as $societe)
{
	$newsociete = str_replace("''", "'", $societe);
	$sheet->setCellValueByColumnAndRow(0,$ligne, $newsociete);
	//echo "<hr>".$societe."<hr>";
	$i=1;
	foreach($tabmois as $mois)
	{
		$donnees = empty($tabdonnees[$societe][$mois])?0:$tabdonnees[$societe][$mois];
		$sheet->setCellValueByColumnAndRow($i,$ligne, $donnees);
		//echo "<hr>".$i."=".$ligne."=>".$donnees;
		$i++;
	}
	$sheet->setCellValueByColumnAndRow($i,$ligne, $tabdonnees[$societe]['TOTAL']);
	$ligne++;
}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Avancement'.date("Y-m-d_Hi").'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
