<?php
// Tableau pour le noms des mois
$year=date('Y');
$month=date('m');
$month=str_replace("0","",$month);

$mois = array();
$mois[1] = "Janvier";
$mois[2] = "Février";
$mois[3] = "Mars";
$mois[4] = "Avril";
$mois[5] = "Mai";
$mois[6] = "Juin";
$mois[7] = "Juillet";
$mois[8] = "Août";
$mois[9] = "Septembre";
$mois[10] = "Octobre";
$mois[11] = "Novembre";
$mois[12] = "DÈcembre";
 
// Tableau pour le noms des jours
$jours = array();
$jours[1] = "Lu";
$jours[2] = "Ma";
$jours[3] = "Me";
$jours[4] = "Je";
$jours[5] = "Ve";
$jours[6] = "Sa";
$jours[7] = "Di";
?>