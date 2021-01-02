<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classificados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="/" class="navbar-brand">Classificados</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="textoNavbar" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav ml-auto">
                    <?php if (isset($_SESSION['login']) && !empty($_SESSION['login'])) : ?>
                        <li class="navbar-text">( <?= $_SESSION['nome'] ?> )</li>
                        <li class="nav-item"><a class="nav-link" href="./meus-anuncios.php">Meus Anúncios</a></li>
                        <li class="nav-item"><a class="nav-link" href="./sair.php">Sair</a></li>
                    <?php else : ?>
                        <li class="nav-item"><a class="nav-link" href="./cadastre-se.php">Cadastre-se</a></li>
                        <li class="nav-item"><a class="nav-link" href="./login.php">Login</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>