<?php $v->layout("softexpertweb/Auth/_template"); ?>

<div class="container mt-5">
    <form action="<?= $router->route("auth.forget"); ?>" method="post" autocomplete="off">


        <div class="row d-flex justify-content-center text-white my-5">
            <div class="col-sm-10 col-md-6 text-center border-bottom">
                <p class="lead">
                    Informe seu E-mail para receber as instruções de recuperação de Senha em sua caixa de entrada.
                </p>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="login_form_callback">
                <?= flash(); ?>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mb-3">
                <label for="inputEmail" class="text-white">E-mail</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                    </div>
                    <input name="email" type="text" class="form-control" id="inputEmail" placeholder="Seu melhor Email">
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 text-center">
                <button class="btn btn-lg btn-greenlight2 btn-block" type="submit">Recuperar minha Senha</button>
            </div>
        </div>

    </form>

    <div class="row d-flex justify-content-center py-3 my-4 text-center">
        <div class="col-6 border-top text-light">
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