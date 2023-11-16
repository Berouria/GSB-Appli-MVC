<?php
/**
 * Gestion des frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * 
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$mois = getMois(date('d/m/Y'));
        
switch ($action) {
case 'choisirVisiteurMois':
    $visiteur = $pdo-> getVisiteurs();
    $lesMois = getLesDouzeDernierMois($mois);
    $lesClesMois = array_keys($lesMois);
    $moisASelectionner = $lesClesMois[0];
    include 'vues/v_listeVisiteurListeMois.php';
    break;
case 'modifierFraisForfait':
    $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
    $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
    var_dump($idVisiteur,$mois);
    $visiteur = $pdo-> getVisiteurs();
    $lesMois = getLesDouzeDernierMois($mois);
    $moisASelectionner = $mois;
    $visiteurASelectionner = $idVisiteur;
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
    include 'vues/v_validerFrais.php';
    break; } 