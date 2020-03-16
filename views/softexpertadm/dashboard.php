<?php $v->layout("softexpertadm/_template"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row d-flex justify-content-center">

    <h1 class="text-center">Olá <?= $user->first_name; ?>,</h1>

</div>
<p class="lead text-center">Aqui é sua conta no projeto, mas por enquanto a única coisa que você pode fazer é acompanhar
    as <b>Vendas</b>
    :P
    <a class="btn btn-outline-info" href="<?= $router->route("sales.home"); ?>">
        <i class="fas fa-ticket-alt"></i>
        Vendas
    </a>
</p>