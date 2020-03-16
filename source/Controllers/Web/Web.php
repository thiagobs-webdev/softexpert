<?php

namespace Source\Controllers\Web;

use Source\Models\User;
use Source\Controllers\Controller;

class Web extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);

        // if (!empty($_SESSION["user"])) {
        //     $this->router->redirect("app.home");
        // }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function home(): void
    {
        $head = $this->seo->optimize(
            "Bem-vindo ao " . site("name"),
            site("desc"),
            $this->router->route("web.home"),
            routeImage("softexpert Produtos/Vendas")
        )->render();

      
        echo $this->view->render("softexpertweb/home", [
            "head" => $head
        ]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function register(): void
    {
        $head = $this->seo->optimize(
            "Crie sua conta no " . site("name"),
            site("desc"),
            $this->router->route("web.register"),
            routeImage("Register")
        )->render();

        $form_user = new \stdClass();
        $form_user->first_name = null;
        $form_user->last_name = null;
        $form_user->email = null;

        echo $this->view->render("softexpertweb/Auth/register", [
            "head" => $head,
            "user" => $form_user
        ]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function login(): void
    {
        $head = $this->seo->optimize(
            "Faça Login para Continuar | " . site("name"),
            site("desc"),
            $this->router->route("web.login"),
            routeImage("Login")
        )->render();

        echo $this->view->render("softexpertweb/Auth/login", [
            "head" => $head
        ]);
    }

     /**
     * Undocumented function
     *
     * @return void
     */
    public function forget(): void
    {
        $head = $this->seo->optimize(
            "Recupere Sua Senha no | " . site("name"),
            site("desc"),
            $this->router->route("web.forget"),
            routeImage("Forget")
        )->render();

        echo $this->view->render("softexpertweb/Auth/forget", [
            "head" => $head
        ]);
    }


    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function reset(array $data): void
    {
        if (empty($_SESSION["forget"])) {
            flash("info", "Informe seu E-MAIL para recuperar a senha");
            $this->router->redirect("web.forget");
        }

        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $forget = filter_var($data["forget"], FILTER_DEFAULT);

        $errForget = "Não foi possível recuperar, tente novamente";
        if (!$email || !$forget) {
            flash("error", $errForget);
            $this->router->redirect("web.forget");
        }

        $user = (new User())->find("email = :e AND forget = :f", "e={$email}&f={$forget}")->fetch();
        if (!$user) {
            flash("error", $errForget);
            $this->router->redirect("web.forget");
        }

        $head = $this->seo->optimize(
            "Crie Sua Nova Senha | " . site("name"),
            site("desc"),
            $this->router->route("web.reset"),
            routeImage("Reset")
        )->render();

        echo $this->view->render("softexpertweb/Auth/reset", [
            "head" => $head
        ]);
    }
    
}
