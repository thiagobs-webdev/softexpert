<?php $v->layout("softexpertweb/Auth/_template");?>

<?php $v->start("css"); ?>
<link rel="stylesheet" href="<?= asset("css/floating-labels.css", "softexpertweb/Auth"); ?>" />
<?php $v->end(); ?>

<form class="form-signin" action="<?= $router->route("auth.login"); ?>" method="post" autocomplete="off">

    <div class="d-flex justify-content-center">
        <div class="login_form_callback">
            <?= flash(); ?>
        </div>
    </div>
    <h3 class="text-center text-white py-2">SofExpert Login</h3>
    <div class="form-label-group">
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Seu E-mail" autofocus>
        <label for="inputEmail">Informe Seu E-mail</label>

        <small id="titlelHelp" class="form-text text-white p-1"><b>Usuário padrão:</b> thiagobs.webdev@gmail.com</small>
    </div>

    <div class="form-label-group">
        <input name="passwd" type="password" id="inputPassword" class="form-control" placeholder="Sua Senha">
        <label for="inputPassword">Informe Sua Senha</label>

        <small id="titlelHelp" class="form-text text-white p-1"><b>Senha padrão:</b> admin123</small>
    </div>

    <!-- <div class="checkbox mb-3">
<label>
<input type="checkbox" value="remember-me"> Remember me
</label>
</div> -->

    <button class="btn btn-lg btn-bluedefault btn-block" type="submit">Login</button>



    <div class="py-3 my-4 text-center border-top text-light">
        <a class="text-white" href="<?= $router->route("web.forget"); ?>"><i>Recuperar Senha</i></a>
        <p class="py-3">
            Não possui uma conta?
            <a href="<?= $router->route("web.register");?>" class="btn btn-sm btn-outline-light">
                Cadastre-se agora
            </a>
        </p>

        <p class="py-3">

            <a href="<?= $router->route("web.home");?>" class="btn btn-sm btn-outline-warning">
                <i class="fas fa-home"></i> Voltar para Home
            </a>
        </p>

    </div>

    <div class="container text-center">
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <p class="mt-5 mb-3 text-white">&copy; <a href="https://thiagobs.me" class="text-white" target="_blank">
                        thiagobs.me</a>
                </p>
            </div>
        </div>
    </div>
</form>


<?php $v->start("scripts"); ?>

<?php $v->end(); ?>