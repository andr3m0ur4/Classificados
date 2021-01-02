<?php

    require './config.php';

    if (empty($_SESSION['login'])) {
        header('Location: ./login.php');
        exit;
    }

    require './classes/Anuncio.php';
    $anuncio = new Anuncio;

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_anuncio = $anuncio->excluirFoto($_GET['id']);
    }

    if (isset($id_anuncio)) {
        header("Location: ./editar-anuncio.php?id={$id_anuncio}");
    } else {
        header('Location: ./meus-anuncios.php');
    }
