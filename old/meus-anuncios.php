<?php

    require './config.php';

    if (empty($_SESSION['login'])) {
        header('Location: ./login.php');
        exit;
    }

    require './classes/Anuncio.php';
    $anuncio = new Anuncio;
    $anuncios = $anuncio->obterMeusAnuncios();

    require './pages/header.php';

    require './pages/meus-anuncios.php';

    require './pages/footer.php';
