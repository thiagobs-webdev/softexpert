<?php $v->layout("softexpertweb/_theme"); ?>

<div class="jumbotron">
    <h2 class="display-4">Bem-vindo ao Sistema de <i>Controle de Produtos/Vendas</i> para Mercado.</h1>

    <p class="lead">
        Sistema criado para o Processo Seletivo da <b>SofExpert</b>.
    </p>
    
    <p class="lead">
        Faça seu Cadastro ou Login para Cadastrar Produtos/Vendas e manter o Controle</i>.
    </p>
    <hr class="my-4">
    <p>

    </p>
    <p>
        Você poderá cadastrar, editar, deletar e listar todos os itens. Venha Conferir.
    </p>
    <div class="text-center mt-5">
        <a class="btn btn-outline-success btn-lg" href="<?= $router->route("web.register"); ?>"
            role="button">Cadastre-se</a>
        <a class="btn btn-outline-dark btn-lg" href="<?= $router->route("web.login"); ?>" title="Login">Login</a>
    </div>

</div>



<?php $v->start("scripts"); ?>

<?php $v->end(); ?>