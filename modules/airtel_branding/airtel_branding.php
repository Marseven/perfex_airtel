<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Airtel Branding
Description: Applique la charte graphique Airtel Gabon (couleurs + logo) sur l'espace admin et l'espace client, sans modifier la structure des pages.
Version: 1.0.1
Requires at least: 2.3.*
Author: Airtel CarTracking
*/

define('AIRTEL_BRANDING_MODULE_NAME', 'airtel_branding');
define('AIRTEL_BRANDING_VERSION', '1.0.1');

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
 * Feuille de style de l'espace admin.
 *
 * @return void
 */
function airtel_branding_admin_head()
{
    echo '<link href="' . module_dir_url(AIRTEL_BRANDING_MODULE_NAME, 'assets/airtel-admin.css')
        . '?v=' . AIRTEL_BRANDING_VERSION . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
}

/**
 * Feuille de style de l'espace client.
 *
 * @return void
 */
function airtel_branding_clients_head()
{
    echo '<link href="' . module_dir_url(AIRTEL_BRANDING_MODULE_NAME, 'assets/airtel-clients.css')
        . '?v=' . AIRTEL_BRANDING_VERSION . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
}
