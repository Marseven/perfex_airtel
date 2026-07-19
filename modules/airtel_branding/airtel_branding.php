<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Airtel Branding
Description: Applique la charte graphique Airtel Gabon (couleurs + logo) sur l'espace admin et l'espace client, sans modifier la structure des pages.
Version: 1.0.0
Requires at least: 2.3.*
Author: Airtel CarTracking
*/

/**
 * IMPORTANT : ce module n'a AUCUNE table ni migration.
 * On garde la version figée à 1.0.0 pour éviter que Perfex ne demande une
 * "mise à jour de la base de données" (qui chercherait une migration inexistante).
 * Le rafraîchissement du CSS est géré par le filemtime des fichiers (voir plus bas),
 * pas par la version du module.
 */
define('AIRTEL_BRANDING_MODULE_NAME', 'airtel_branding');
define('AIRTEL_BRANDING_VERSION', '1.0.0');

/**
 * Activation : rien de destructif, tout passe par du CSS injecté.
 */
register_activation_hook(AIRTEL_BRANDING_MODULE_NAME, 'airtel_branding_activation_hook');

function airtel_branding_activation_hook()
{
    require_once __DIR__ . '/install.php';
}

/**
 * Injection du CSS dans l'espace admin (back-office) et l'écran de connexion admin.
 */
hooks()->add_action('app_admin_head', 'airtel_branding_admin_head');
hooks()->add_action('app_admin_authentication_head', 'airtel_branding_admin_head');

/**
 * Injection du CSS dans l'espace client (portail) et les formulaires externes.
 */
hooks()->add_action('app_customers_head', 'airtel_branding_clients_head');
hooks()->add_action('app_external_form_head', 'airtel_branding_clients_head');

/**
 * Version de cache basée sur la date de modification du fichier CSS.
 * Change automatiquement à chaque édition du CSS -> casse le cache navigateur,
 * sans jamais toucher à la version du module.
 *
 * @param string $file nom du fichier dans assets/
 * @return int|string
 */
function airtel_branding_asset_ver($file)
{
    $path = module_dir_path(AIRTEL_BRANDING_MODULE_NAME, 'assets/' . $file);

    return is_file($path) ? filemtime($path) : AIRTEL_BRANDING_VERSION;
}

/**
 * Feuille de style de l'espace admin.
 *
 * @return void
 */
function airtel_branding_admin_head()
{
    echo '<link href="' . module_dir_url(AIRTEL_BRANDING_MODULE_NAME, 'assets/airtel-admin.css')
        . '?v=' . airtel_branding_asset_ver('airtel-admin.css') . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
}

/**
 * Feuille de style de l'espace client.
 *
 * @return void
 */
function airtel_branding_clients_head()
{
    echo '<link href="' . module_dir_url(AIRTEL_BRANDING_MODULE_NAME, 'assets/airtel-clients.css')
        . '?v=' . airtel_branding_asset_ver('airtel-clients.css') . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
}
