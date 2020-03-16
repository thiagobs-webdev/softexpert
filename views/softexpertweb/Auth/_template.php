<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?= $head; ?>

    <link rel="stylesheet" href="<?= site(); ?>/_cdn/css/app.css" />
    <link rel="stylesheet" href="<?= site(); ?>/_cdn/css/fontawesome-all.min.css" />

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>
    
    <link rel="stylesheet" href="<?= asset("css/custom.css", "softexpertweb/Auth"); ?>" />

    <?= $v->section("css"); ?>

</head>

<body class="bg-bluedark">
    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <div class="ajax_load_box_title">Aguarde, carrengando...</div>
        </div>
    </div>

    <main class="main_content">

        <?= $v->section("content"); ?>


    </main>

    <script src="<?= asset("js/jquery.js", "softexpertweb/Auth"); ?>"></script>
    <script src="<?= asset("js/jquery-ui.js", "softexpertweb/Auth"); ?>"></script>
    <script src="<?= asset("js/form.js", "softexpertweb/Auth"); ?>"></script>

</body>

</html>