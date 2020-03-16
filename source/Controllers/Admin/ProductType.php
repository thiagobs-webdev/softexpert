<?php

namespace Source\Controllers\Admin;

use Source\Controllers\Controller;
use Source\Models\User;
use Source\Models\Admin\ProductType as ProdType;
use Source\Models\Admin\TypeTaxe as Taxe;

class ProductType extends AdminController
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
            "Categorias | " . site("name"),
            site("desc"),
            $this->router->route("categories.home"),
            routeImage("Categorias"),
            false
        )->render();


        echo $this->view->render("softexpertadm/widgets/categories/home", [
            "head" => $head,
            "user" => $this->user,
            "productTypes" => (new ProdType())->find()->order("created_at DESC")->fetch(true),
            "taxes" => (new Taxe())->find()->order("name ASC")->fetch(true),
            // "taxeJson" => json_encode($taxeJson)
        ]);
    }

    public function store(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos para cadastrar o Tipo de Produto!"
            ]);
            return;
        }

        // Exist Taxe?
        $taxe = (new Taxe())->findById($data["type_taxe"]);
        if (!$taxe) {
            echo $this->ajaxResponse("message", [
                "type" => "info",
                "message" => "Você Selecionou um Tipo de Taxa que não existe!"
            ]);
            return;
        }
        
        $productType = new ProdType();
        $productType->name = $data["name"];
        $productType->product_type_taxes_id = $taxe->id;
        $productType->registered_by_id = $this->user->id;

        // \var_dump($product); die;
        if (!$productType->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $productType->fail()->getMessage()
            ]);
            return;
        }

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("categories.home"),
            "type" => "success",
            "message" => "Tipo de Produto Cadastrado com Sucesso!"
        ]);
    }


    public function delete(array $data): void
    {
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $typeDelete = (new ProdType())->findById($data["type_id"]);

            if (!$typeDelete) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Você tentou deletar um Tipo de Produto que não existe!"
                ]);
                return;
            }

            
            $typeDelete->destroy();
            
            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("categories.home"),
                "type" => "success",
                "message" => "Tipo de Produto exluído com Sucesso!"
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
                "message" => "Preencha todos os campos para cadastrar o Tipo de Produto!"
            ]);
            return;
        }

        // Exist Product?
        $taxeId = filter_var($data["type_taxe"], FILTER_VALIDATE_INT);
        $taxe = (new Taxe())->findById($taxeId);
        if (!$taxe) {
            echo $this->ajaxResponse("message", [
                "type" => "info",
                "message" => "Você Selecionou uma Taxa que não existe!"
            ]);
            return;
        }

        if (!empty($data["type_id"])) {
            $typetId = filter_var($data["type_id"], FILTER_VALIDATE_INT);
            $typeEdit = (new ProdType())->findById($typetId);
        }
        
        $typeEdit->name = $data["name"];
        $typeEdit->product_type_taxes_id = $taxe->id;
        
        if (!$typeEdit->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $typeEdit->fail()->getMessage()
            ]);
            return;
        }

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("categories.home"),
            "type" => "success",
            "message" => "Tipo de Produto Cadastrado com Sucesso!"
        ]);
    }
}