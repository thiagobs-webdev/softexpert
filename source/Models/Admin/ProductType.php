<?php

namespace Source\Models\Admin;

use CoffeeCode\DataLayer\DataLayer;
use Exception;
use Source\Models\Admin\TypeTaxe as Taxe;
use Source\Models\User;


class ProductType extends DataLayer
{
    /**
     * Product Constructor
     */
    public function __construct()
    {
        parent::__construct("product_types", ["name", "product_type_taxes_id", "registered_by_id"]);
    }

    /**
     * Undocumented function
     *
     * @return Taxe
     */
    public function taxe(): Taxe
    {
        return (new Taxe())->findById($this->product_type_taxes_id);
    }

     /**
     * Undocumented function
     *
     * @return 
     */
    public function taxeJson()
    {
        $taxeJsonret = [];
        $taxes = (new Taxe())->find()->order("name ASC")->fetch(true);

        foreach ($taxes as $taxe) {
            
            $taxeJson[] = array($taxe->id, $taxe->name);
        }
  
        return json_encode(["taxe" => $taxeJson]);
    }

    /**
     * Undocumented function
     *
     * @return User
     */
    public function user(): User
    {
        return (new User())->findById($this->registered_by_id);
    }



}
