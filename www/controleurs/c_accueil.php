<?php
/**
 * Gestion de l'accueil
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
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

$estConnecteVisiteur = estConnecteVisiteur();
$estConnecteComptable = estConnecteComptable();
if ($estConnecteVisiteur ) {
    include 'vues/v_accueil_visiteur.php';
} elseif ($estConnecteComptable) {
    include 'vues/v_accueil_comptable.php';
} 
else {
    include 'vues/v_connexion.php';
}
