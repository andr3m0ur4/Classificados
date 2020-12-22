<?php

    require './config.php';

    require './classes/Anuncio.php';
    require './classes/Usuario.php';
    $anuncio = new Anuncio;
    $usuario = new Usuario;

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = addslashes($_GET['id']);
    } else {
        header('Location: ./');
        exit;
    }

    $dado = $anuncio->obterAnuncio($id);

    require './pages/header.php';

    require './pages/produto.php';

    require './pages/footer.php';