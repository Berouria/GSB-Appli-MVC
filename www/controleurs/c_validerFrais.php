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
        $visiteur = $pdo->getVisiteurs();
        $lesMois = getLesDouzeDernierMois($mois);
        $lesClesMois = array_keys($lesMois);
        $moisASelectionner = $lesClesMois[0];
        include 'vues/v_listeVisiteurListeMois.php';
        break;
    case 'afficherDonneesVisiteur':
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $visiteur = $pdo->getVisiteurs();
        $lesMois = getLesDouzeDernierMois($mois);
        $moisASelectionner = $leMois;
        $visiteurASelectionner = $idVisiteur;
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        if (empty($lesFraisForfait)) {
            ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
            include 'vues/v_erreurs.php';
            include 'vues/v_listeVisiteurListeMois.php';
        } else {
            include 'vues/v_validerFrais.php';
        }
        break;
    case 'modifierFraisForfait':
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $visiteur = $pdo->getVisiteurs();
        $lesMois = getLesDouzeDernierMois($mois);
        $moisASelectionner = $leMois;
        $visiteurASelectionner = $idVisiteur;
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        if (lesQteFraisValides($lesFrais)) {
            $pdo->majFraisForfait($idVisiteur, $leMois, $lesFrais);
             $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
             $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
             include 'vues/v_validerFrais.php';
        } else {
            ajouterErreur('Les valeurs des frais doivent être numériques');
            include 'vues/v_erreurs.php';
        }
        break;
        
    case 'corrigerFraisHorsForfait':
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $visiteur = $pdo->getVisiteurs();
        $lesMois = getLesDouzeDernierMois($mois);
        $moisASelectionner = $leMois;
        $visiteurASelectionner = $idVisiteur;
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
        $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
        $pdo->majFraisHorsForfait($idVisiteur,$lesFraisHorsForfait,$libelle,$date,$montant);
        var_dump($date,$libelle,$montant,$lesFraisHorsForfait,$idVisiteur);
        include 'vues/v_validerFrais.php';
        break;
} 