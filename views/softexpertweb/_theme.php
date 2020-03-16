<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <?= $head; ?>
    <link rel="stylesheet" href="<?= site(); ?>/_cdn/css/app.css" />

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-bluedefault">
        <div class="container-xl">
            <a class="navbar-brand" href="<?= $router->route("web.home") ;?>">SofExpert</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07XL"
                aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample07XL">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= $router->route("web.home") ;?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown07XL" data-toggle="dropdown"
                            aria-expanded="false">Mais</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown07XL">
                            <a class="dropdown-item" href="#">Cadastrar</a>
                            <a class="dropdown-item" href="#">Login</a>
                        </div>
                    </li>
                </ul>
                <div class="my-2 my-md-0">
                    <a href="<?= $router->route("web.login"); ?>" class="btn btn-md btn-outline-light">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="main_content container my-4">
        <?= $v->section("content"); ?>
    </main>

    <footer class="bg-bluedefault text-white py-4 mt-5">
        <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://thiagobs.me/" class="text-white" target="_blank"> thiagobs.me</a>
  </div>
  <!-- Copyright -->
    </footer>
    

    <script src="<?= site(); ?>/_cdn/js/jquery-3.4.1.min.js"></script>
    <script src="<?= site(); ?>/_cdn/js/bootstrap.bundle.min.js"></script>

    <?= $v->section("scripts"); ?>
</body>

</html>