<?php

namespace Source\Models\Admin;

use CoffeeCode\DataLayer\DataLayer;
use Exception;
use Source\Models\User;
use Source\Models\Admin\ProductType;

class Product extends DataLayer
{
    /**
     * Product Constructor
     */
    public function __construct()
    {
        parent::__construct("products", ["name", "price", "product_type_id", "registered_by_id"]);
    }

    // /**
    //  * Undocumented function
    //  *
    //  * @return bool
    //  */
    // public function save(): bool
    // {

    //     $user = (new Product())->find("name = :name", "name={$this->name}")->fetch();
    //     if (!$user) {
           
    //         return false;
    //     }else{
    //         parent::save();
    //         return true;
    //     }
       
    // }

    /**
     * Undocumented function
     *
     * @return User
     */
    public function user(): User
    {
        return (new User())->findById($this->registered_by_id);
    }

    /**
     * Undocumented function
     *
     * @return ProductType
     */
    public function type(): ProductType
    {
        return (new ProductType())->findById($this->product_type_id);
    }


    

}
