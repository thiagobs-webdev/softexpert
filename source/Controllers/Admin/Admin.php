<?php

namespace Source\Controllers\Admin;

use Source\Models\User;
use Source\Controllers\Controller;

class Admin extends AdminController
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

        if (empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])) {
            unset($_SESSION["user"]);

            flash("error", "Acesso negado. Favor logue-se");
            $this->router->redirect("web.login");
        }

        // ACESS RESTRICTION
    }

    public function home(): void
    {
        $head = $this->seo->optimize(
            "Bem-vindo(a) {$this->user->first_name} | " . site("name"),
            site("desc"),
            $this->router->route("admin.home"),
            routeImage("Conta de {$this->user->first_name}"),
            false
        )->render();

        echo $this->view->render("softexpertadm/dashboard", [
            "head" => $head,
            "user" => $this->user
        ]);
    }

    public function logoff(): void
    {
        unset($_SESSION["user"]);

        flash("info", "Você saiu com sucesso, volte logo {$this->user->first_name}");
        $this->router->redirect("web.login");
    }
}
