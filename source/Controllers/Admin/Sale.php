<?php

namespace Source\Controllers\Admin;

use Source\Controllers\Controller;
use Source\Models\User;
use Source\Models\Admin\Product as Prod;
use Source\Models\Admin\ProductType as ProdType;
use Source\Models\Admin\Sale as SaleProd;

class Sale extends AdminController
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
            "Vendas | " . site("name"),
            site("desc"),
            $this->router->route("sales.home"),
            routeImage("Vendas"),
            false
        )->render();

        $sales = (new SaleProd())->find()->order("created_at DESC")->fetch(true);

        $saleValueTotal = 0;
        $saleTaxeTotal = 0;
        if ($sales) {
            foreach ($sales as $sale) {
                $saleValueTotal += $saleTotalCurrent =  $sale->product()->price * $sale->amount;
                $saleTaxeTotal += ($saleTotalCurrent) * percentage_sub($sale->product()->type()->taxe()->percentage);
            }
        }
        echo $this->view->render("softexpertadm/widgets/sales/home", [
            "head" => $head,
            "user" => $this->user,
            "sales" => $sales,
            "products" => (new Prod())->find()->order("name ASC")->fetch(true),
            "saleValueTotal" => $saleValueTotal,
            "saleTaxeTotal" => $saleTaxeTotal
        ]);
    }

    public function store(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos para cadastrar a Venda!"
            ]);
            return;
        }


        // Exist Product?
        $product = (new Prod())->findById($data["sale_product"]);
        if (!$product) {
            echo $this->ajaxResponse("message", [
                "type" => "info",
                "message" => "Você Selecionou um Tipo de Produto que não existe!"
            ]);
            return;
        }
        $sale = new SaleProd();
        $sale->product_id = $product->id;
        $sale->amount = (filter_var($data['amount'], FILTER_VALIDATE_INT) ? $data['amount'] : "");
        $sale->registered_by_id = $this->user->id;

        if (!$sale->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $sale->fail()->getMessage()
            ]);
            return;
        }

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("sales.home"),
            "type" => "success",
            "message" => "Venda Cadastrada com Sucesso!"
        ]);
    }


    public function delete(array $data): void
    {
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $saleDelete = (new SaleProd())->findById($data["sale_id"]);

            if (!$saleDelete) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Você tentou deletar uma Venda que não existe!"
                ]);
                return;
            }

            
            $saleDelete->destroy();
            
            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("sales.home"),
                "type" => "success",
                "message" => "Venda exluído com Sucesso!"
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
                "message" => "Preencha todos os campos para cadastrar a Venda!"
            ]);
            return;
        }

        // Exist Product?
        $productId = filter_var($data["sale_product"], FILTER_VALIDATE_INT);
        $product = (new Prod())->findById($productId);
        if (!$product) {
            echo $this->ajaxResponse("message", [
                "type" => "info",
                "message" => "Você Selecionou um Produto que não existe!"
            ]);
            return;
        }

        if (!empty($data["sale_id"])) {
            $saleId = filter_var($data["sale_id"], FILTER_VALIDATE_INT);
            $saleEdit = (new SaleProd())->findById($saleId);
        }
        
        $saleEdit->product_id = $product->id;
        $saleEdit->amount = (filter_var($data['amount'], FILTER_VALIDATE_INT) ? $data['amount'] : "0");
        
        if (!$saleEdit->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $saleEdit->fail()->getMessage()
            ]);
            return;
        }

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("sales.home"),
            "type" => "success",
            "message" => "Venda Cadastrada com Sucesso!"
        ]);
    }
}