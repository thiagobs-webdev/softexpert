<?php $v->layout("softexpertweb/Auth/_template"); ?>

<div class="container mt-5">
    <form action="<?= $router->route("auth.register"); ?>" method="post" autocomplete="off">

        <div class="d-flex justify-content-center">
            <div class="login_form_callback">
                <?= flash(); ?>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-3 mb-3">
                <label for="firstName" class="text-white">Primeiro Nome</label>
                <input name="first_name" type="text" class="form-control" id="firstName" placeholder="Primeiro Nome" 
                value="<?= $user->first_name; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label for="lastName" class="text-white">Sobrenome</label>
                <input name="last_name" type="text" class="form-control" id="lastName" placeholder="Sobrenome" 
                value="<?= $user->last_name; ?>">
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mb-3">
                <label for="inputEmail" class="text-white">E-mail</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                    </div>
                    <input name="email" type="text" class="form-control" id="inputEmail" placeholder="Seu melhor Email" 
                    value="<?= $user->email; ?>">
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mb-3">
                <label for="inputPasswd" class="text-white">Senha</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input name="passwd" type="password" class="form-control" id="inputPasswd" placeholder="Senha">
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 text-center">
                <button class="btn btn-lg btn-bluedefault btn-block" type="submit">Criar Conta</button>
            </div>
        </div>

    </form>

    <div class="row d-flex justify-content-center py-3 my-4 text-center">
        <div class="col-6 border-top text-light">
            <p class="py-3">
                Já possui uma conta?
                <a href="<?= $router->route("web.login");?>" class="btn btn-sm btn-outline-light">
                    Fazer Login
                </a>
            </p>

        </div>
    </div>


</div>

<div class="container text-center">
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <p class="mt-5 mb-3 text-muted">&copy; <a href="https://thiagobs.me" target="_blank">
                        thiagobs.me</a>
                </p>
            </div>
        </div>
    </div>


<?php $v->start("scripts"); ?>

<?php $v->end(); ?>