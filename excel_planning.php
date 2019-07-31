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
							 ->setSubject("Planning")
							 ->setDescription("Table de donnees pour le plan de roulement");


// TODO : Afficher les colonnes et extraire toutes les données de la table tdd_flash
$sheet = $objPHPExcel->getActiveSheet(); // On active d'abord le sheet
// Rename worksheet
$sheet->setTitle('Planning');

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
$tabdate = array();
$tabstation = array();
$tabhoraire = array();

$sql = "SELECT date, station, horaire FROM `stif_planning` ORDER BY date, horaire";
$selection = $bdd->query($sql);
while($liste = $selection->fetch())
{
	array_push($tabdate, $liste['date']);
	array_push($tabstation, $liste['station']);
	array_push($tabhoraire, $liste['horaire']);
}
$selection->closeCursor();

// Remplissage des en-têtes de colonnes :
$sheet->setCellValueByColumnAndRow(0,1, "Date Planning");
$sheet->setCellValueByColumnAndRow(1,1, "Station");
$sheet->setCellValueByColumnAndRow(2,1, "Horaires");

// Remplissage des données :
for($i=0; $i<count($tabdate);$i++)
{
	$j=$i+2;
	$sheet->setCellValueByColumnAndRow(0,$j, $tabdate[$i]);
	$sheet->setCellValueByColumnAndRow(1,$j, $tabstation[$i]);
	$sheet->setCellValueByColumnAndRow(2,$j, $tabhoraire[$i]);
	//echo "<br>".$tabdate[$i]."|".$tabstation[$i]."|".$tabhoraire[$i];
}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Planning'.date("Y-m-d_Hi").'.xls"');
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