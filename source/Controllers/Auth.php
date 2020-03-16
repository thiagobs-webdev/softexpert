<?php

namespace Source\Controllers;

use Source\Models\User;
use Source\Support\Email;


class Auth extends Controller
{
    /**
     * Auth Constructor
     *
     * @param [type] $router
     */
    public function __construct($router)
    {
        parent::__construct($router);
    }


    public function login(array $data): void
    {
        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $passwd = filter_var($data["passwd"], FILTER_DEFAULT);

        if (!$email || !$passwd) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe seu e-mail e senha para logar!"
            ]);
            return;
        }

        $user = (new User())->find("email = :e", "e={$email}")->fetch();
        if (!$user || !password_verify($passwd, $user->passwd)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Email ou senha informados não conferem!"
            ]);
            return;
        }


        $_SESSION["user"] = $user->id;
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("admin.home")
        ]);
    }


    /**
     * Register Users
     *
     * @param [type] $data
     * @return void
     */
    public function register(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos para cadastrar-se!"
            ]);
            return;
        }

        $user = new User();
        $user->first_name = $data["first_name"];
        $user->last_name = $data["last_name"];
        $user->email = $data["email"];
        $user->passwd = $data["passwd"];
        

        if (!$user->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $user->fail()->getMessage()
            ]);
            return;
        }

        $_SESSION["user"] = $user->id;
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("admin.home")
        ]);
    }

    public function forget($data): void
    {
        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);

        if (!$email) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe o SEU EMAIL para recuperar a senha"
            ]);
            return;
        }

        $user = (new User())->find("email = :e", "e={$email}")->fetch();

        if (!$user) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O E-MAIL informado não está cadastrado"
            ]);
            return;
        }

        $user->forget = (md5(uniqid(rand(), true)));
        $user->save();

        $_SESSION["forget"] = $user->id;

        $email = new Email();
        $email->add(
            "Recupere sua senha | " . site("name"),
            $this->view->render("softexpertweb/Auth/emails/recover", [
                "user" => $user,
                "link" => $this->router->route("web.reset", [
                    "email" => $user->email,
                    "forget" => $user->forget
                ])
            ]),
            "{$user->first_name} {$user->last_name}",
            $user->email
        )->send();

        flash("success", "Enviamos um link de recuperação para seu e-mail");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.forget")
        ]);
        return;
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function reset(array $data): void
    {
        if (empty($_SESSION["forget"]) || !$user = (new User())->findById($_SESSION["forget"])) {
            flash("error", "Não foi possível recuperar, tente novamente");
            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("web.forget")
            ]);
            return;
        }

        if (empty($data["passwd"]) || empty($data["passwd_re"])) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe e repita sua nova senha"
            ]);
            return;
        }

        if ($data["passwd"] != $data["passwd_re"]) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Senhas não conferem"
            ]);
            return;
        }

        $user->passwd = $data["passwd"];
        $user->forget = null;

        if (!$user->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => $user->fail()->getMessage()
            ]);
            return;
        }

        unset($_SESSION["forget"]);
        flash("success", "Sua senha foi atualizada com sucesso");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.login")
        ]);
    }

    
}
