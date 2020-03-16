<?php

ob_start();
session_start();

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(site());
// $router->namespace("Source\Controllers");

/**
 * WEB ROUTES
 */
$router->namespace("Source\Controllers\Web");
$router->group(null);
$router->get("/", "Web:home", "web.home");
$router->get("/login", "Web:login", "web.login");
$router->get("/cadastrar", "Web:register", "web.register");
$router->get("/recuperar", "Web:forget", "web.forget");
$router->get("/senha/{email}/{forget}", "Web:reset", "web.reset");


/**
 * AUTH
 */
$router->namespace("Source\Controllers");
$router->group(null);
$router->post("/login", "Auth:login", "auth.login");
$router->post("/register", "Auth:register", "auth.register");
$router->post("/forget", "Auth:forget", "auth.forget");
$router->post("/reset", "Auth:reset", "auth.reset");


/**
 * Admin Routes
 */
$router->namespace("Source\Controllers\Admin");
$router->group("/admin");
$router->get("/", "Admin:home", "admin.home");
$router->get("/sair", "Admin:logoff", "admin.logoff");

/**
 * Admin Products
 */
$router->get("/produtos", "Product:home", "products.home");
$router->post("/produtos/store", "Product:store", "products.store");
$router->post("/produtos/delete", "Product:delete", "products.delete");
$router->post("/produtos/update", "Product:update", "products.update");

/**
 * Admin Products Types
 */
$router->get("/produtos/categorias", "ProductType:home", "categories.home");
$router->post("/produtos/categorias/store", "ProductType:store", "categories.store");
$router->post("/produtos/categorias/delete", "ProductType:delete", "categories.delete");
$router->post("/produtos/categorias/update", "ProductType:update", "categories.update");

/**
 * Admin Types Taxes
 */
$router->get("/categorias/taxas", "TypeTaxe:home", "taxes.home");
$router->post("/categorias/taxas/store", "TypeTaxe:store", "taxes.store");
$router->post("/categorias/taxas/delete", "TypeTaxe:delete", "taxes.delete");
$router->post("/categorias/taxas/update", "TypeTaxe:update", "taxes.update");

/**
 * Admin sales
 */
$router->get("/vendas", "Sale:home", "sales.home");
$router->post("/vendas/store", "Sale:store", "sales.store");
$router->post("/vendas/delete", "Sale:delete", "sales.delete");
$router->post("/vendas/update", "Sale:update", "sales.update");






/**
 * ERRORS
 */
$router->group("ops");
$router->get("/{errcode}", "Web:error", "web.error");


/**
 * ROUT PROCESS
 */
$router->dispatch();

/**
 * ERRORS PROCESS
 */
if ($router->error()) {
    $router->redirect("web.error", ["errcode" => $router->error()]);
}

ob_end_flush();