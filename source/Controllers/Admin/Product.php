<?php

namespace Source\Controllers\Admin;

use Source\Controllers\Controller;
use Source\Models\User;
use Source\Models\Admin\Product as Prod;
use Source\Models\Admin\ProductType as ProdType;

class Product extends AdminController
{
    /** @var User */
    protected $user;

    /**
     * Undocumented function
     *
     * @param [type] $router
     */
    public function __construct($router)
    {
        parent::__construct($router);
        
    }

    public function home(): void
    {
        
        $head = $this->seo->optimize(
            "Produtos | " . site("name"),
            site("desc"),
            $this->router->route("products.home"),
            routeImage("Produtos"),
            false
        )->render();

        echo $this->view->render("softexpertadm/widgets/products/home", [
            "head" => $head,
            "user" => $this->user,
            "productTypes" => (new ProdType())->find()->order("name ASC")->fetch(true),
            "products" => (new Prod())->find()->order("created_at DESC")->fetch(true)
        ]);
    }

    public function store(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos para cadastrar o Produto!"
            ]);
            return;
        }


        // Exist Product Type?
        $prodType = (new ProdType())->findById($data["product_type"]);
        if (!$prodType) {
            echo $this->ajaxResponse("message", [
                "type" => "info",
                "message" => "Você Selecionou um Tipo de Produto que não existe!"
            ]);
            return;
        }
        $product = new Prod();
        $product->name = $data["name"];
        $product->price = str_replace([".", ","], ["", "."], $data["price"]);
        $product->product_type_id = $prodType->id;
        $product->registered_by_id = $this->user->id;

        if (!$product->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $product->fail()->getMessage()
            ]);
            return;
        }

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("products.home"),
            "type" => "success",
            "message" => "Produto Cadastrado com Sucesso!"
        ]);
    }


    public function delete(array $data): void
    {
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $productDelete = (new Prod())->findById($data["product_id"]);

            if (!$productDelete) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Você tentou deletar um Produto que não existe!"
                ]);
                return;
            }

            
            $productDelete->destroy();
            
            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("products.home"),
                "type" => "success",
                "message" => "Produto exluído com Sucesso!"
            ]);
            return;
        }
    }


    public function update(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos para cadastrar o Produto!"
            ]);
            return;
        }

        if (!empty($data["product_id"])) {
            $productId = filter_var($data["product_id"], FILTER_VALIDATE_INT);
            $productEdit = (new Prod())->findById($productId);
        }
        
        $productEdit->name = $data["name"];
        $productEdit->price = str_replace([".", ","], ["", "."], $data["price"]);
        // $productEdit->status = 1;
        
        if (!$productEdit->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $productEdit->fail()->getMessage()
            ]);
            return;
        }

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("products.home"),
            "type" => "success",
            "message" => "Produto Cadastrado com Sucesso!"
        ]);
    }
}