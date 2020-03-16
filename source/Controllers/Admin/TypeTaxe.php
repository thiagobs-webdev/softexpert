<?php

namespace Source\Controllers\Admin;

use Source\Controllers\Controller;
use Source\Models\User;
use Source\Models\Admin\TypeTaxe as Taxe;

class TypeTaxe extends AdminController
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
            "Taxas | " . site("name"),
            site("desc"),
            $this->router->route("taxes.home"),
            routeImage("Taxas"),
            false
        )->render();

        echo $this->view->render("softexpertadm/widgets/taxes/home", [
            "head" => $head,
            "user" => $this->user,
            "taxes" => (new Taxe())->find()->order("created_at DESC")->fetch(true)
        ]);
    }

    public function store(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos para cadastrar a Taxa!"
            ]);
            return;
        }
        
        $taxe = new Taxe();
        $taxe->name = $data["name"];
        $taxe->percentage = str_replace([".", ","], ["", "."], $data["percentage"]);
        $taxe->registered_by_id = $this->user->id;

        // \var_dump($product); die;
        if (!$taxe->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $taxe->fail()->getMessage()
            ]);
            return;
        }

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("taxes.home"),
            "type" => "success",
            "message" => "Taxa Cadastrada com Sucesso!"
        ]);
    }


    public function update(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos para cadastrar a Taxa!"
            ]);
            return;
        }

        if (!empty($data["taxe_id"])) {
            $taxetId = filter_var($data["taxe_id"], FILTER_VALIDATE_INT);
            $taxeEdit = (new Taxe())->findById($taxetId);
        }
        
        $taxeEdit->name = $data["name"];
        $taxeEdit->percentage = str_replace([".", ","], ["", "."], $data["percentage"]);
        
        if (!$taxeEdit->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $taxeEdit->fail()->getMessage()
            ]);
            return;
        }

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("taxes.home"),
            "type" => "success",
            "message" => "Taxa Cadastrada com Sucesso!"
        ]);
    }

    public function delete(array $data): void
    {
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $taxeDelete = (new Taxe())->findById($data["taxe_id"]);

            if (!$taxeDelete) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Você tentou deletar uma Taxa que não existe!"
                ]);
                return;
            }

            
            $taxeDelete->destroy();
            
            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("taxes.home"),
                "type" => "success",
                "message" => "Taxa exluída com Sucesso!"
            ]);
            return;
        }
    }

}