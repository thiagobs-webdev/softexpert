<?php

namespace Source\Models\Admin;

use CoffeeCode\DataLayer\DataLayer;
use Exception;
use Source\Models\User;
use Source\Models\Admin\ProductType;
use Source\Models\Admin\Product;

class Sale extends DataLayer
{
    /**
     * Product Constructor
     */
    public function __construct()
    {
        parent::__construct("sales", ["product_id", "amount", "registered_by_id"]);
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


    /**
     * Undocumented function
     *
     * @return Product
     */
    public function product(): Product
    {
        return (new Product())->findById($this->product_id);
    }

}
