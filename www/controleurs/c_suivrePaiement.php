<?php

/**
 * Suivre le paiement
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

switch ($action) {
    case 'afficherVisiteurMois':
        $visiteur = $pdo->getVisiteursVA();
        $lesMois = $pdo->getMoisVA();
        $lesClesMois[] = array_keys($lesMois);
        $moisASelectionner = $lesClesMois[0];
        include 'vues/v_suivrePaiement.php';
        break;
}