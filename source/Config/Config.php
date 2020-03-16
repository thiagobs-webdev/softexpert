<?php

/**
 * SITE CONFIG
 * http://localhost/softexpert
 */
define("SITE", [
    "name" => "Controle de Produtos/Vendas.",
    "desc" => "App test do processo seletivo SoftExpert para Controle de Vendas",
    "domain" => "softexpert.thiagobs.me/",
    "locale" => "pt_BR",
    "root" => "http://localhost/softexpert" // sem a barra no final
]);


/**
 * VIEW
 */
define("CONF_VIEW_EXT", "php");


/**
 * SITE MINIFY
 */
if ($_SERVER["SERVER_NAME"] == "localhost") {
    // require __DIR__ . "/Minify.php";
}

/**
 * DATABASE
 */
define("DATA_LAYER_CONFIG", [
    "driver" => "pgsql",
    "host" => "localhost",
    "port" => "5432",
    "dbname" => "soft_expert",
    "username" => "thiagobs",
    "passwd" => "Sexper$27(",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);


/**
 * SOCIAL CONFIG
 */
define("SOCIAL", [
    "facebook_page" => "softexpert",
    "facebook_author" => "softexpert",
    "facebook_appId" => "11111111",
    "twitter_creator" => "softexpert",
    "twitter_site" => "softexpert",
]);


/**
 * MAIL CONNECT
 */

define("MAIL", [
    "host" => "smtp.sendgrid.net",
    "port" => "587",
    "user" => "apikey",
    "passwd" => "your_key",
    "from_name" => "Thiago Bomfim",
    "from_email" => "thiagobs.webdev@gmail.com"
]);
