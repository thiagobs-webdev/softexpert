<?php

namespace Source\Models\Admin;

use CoffeeCode\DataLayer\DataLayer;
use Exception;
use Source\Models\User;

class TypeTaxe extends DataLayer
{
    /**
     * Product Constructor
     */
    public function __construct()
    {
        parent::__construct("product_type_taxes", ["name", "percentage", "registered_by_id"]);
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
