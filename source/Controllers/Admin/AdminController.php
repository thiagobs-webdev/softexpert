<?php

namespace Source\Controllers\Admin;

use Source\Controllers\Controller;
use Source\Models\User;

/**
 * Class Admin
 * @package Source\App\Admin
 */
class AdminController extends Controller
{
    /**
     * @var \Source\Models\User|null
     */
    protected $user;

    /**
     * Admin constructor.
     */
    public function __construct($router)
    {
        parent::__construct($router);

        if (empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])) {
            unset($_SESSION["user"]);

            flash("error", "Acesso negado. Favor logue-se");
            $this->router->redirect("web.login");
        }
        
    }
}