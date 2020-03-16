<?php $v->layout("softexpertweb/Auth/_template"); ?>

<div class="container mt-5 pt-5">
    <form name="reset" action="<?= $router->route("auth.reset"); ?>" method="post" autocomplete="off">


        <div class="d-flex justify-content-center">
            <div class="login_form_callback">
                <?= flash(); ?>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-10 col-sm-7 col-md-6 col-lg-6 mb-3">
                <label for="inputEmail" class="text-white">Nova Senha</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></i></span>
                    </div>
                    <input name="passwd" type="password" class="form-control" id="inputEmail"
                        placeholder="Digite sua nova Senha">
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-10 col-sm-7 col-md-6 col-lg-6 mb-3">
                <label for="inputEmail" class="text-white">Confirmação</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></i></span>
                    </div>
                    <input name="passwd_re" type="password" class="form-control" id="inputEmail"
                        placeholder="Confirme sua nova Senha">
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-10 col-sm-7 col-md-6 col-lg-6 text-center">
                <button class="btn btn-lg btn-greenlight2 btn-block" type="submit">Atualizar Minha Senha</button>
            </div>
        </div>

    </form>

    <div class="row d-flex justify-content-center py-3 my-4 text-center">
        <div class="col-10 col-sm-7 col-md-6 col-lg-6 border-top text-light">
            <p class="py-3">
                Lembrou da Senha?
                <a href="<?= $router->route("web.login");?>" class="btn btn-sm btn-outline-secondary">
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