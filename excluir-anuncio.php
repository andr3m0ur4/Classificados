<?php

    require './config.php';

    if (empty($_SESSION['login'])) {
        header('Location: ./login.php');
        exit;
    }

    require './classes/Anuncio.php';
    $anuncio = new Anuncio;

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $anuncio->excluirAnuncio($_GET['id']);
    }

    header('Location: ./meus-anuncios.php');
