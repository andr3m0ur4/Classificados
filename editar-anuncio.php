<?php

    require './config.php';

    if (empty($_SESSION['login'])) {
        header('Location: ./login.php');
        exit;
    }

    require './classes/Anuncio.php';
    $anuncio = new Anuncio;
    $sucesso = false;

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header('Location: ./meus-anuncios.php');
        exit;
    }
    
    if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
        $titulo = addslashes($_POST['titulo']);
        $categoria = addslashes($_POST['categoria']);
        $valor = addslashes($_POST['valor']);
        $descricao = addslashes($_POST['descricao']);
        $estado = addslashes($_POST['estado']);
        $fotos = [];

        if (isset($_FILES['fotos'])) {
            $fotos = $_FILES['fotos'];
        }

        $anuncio->editarAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $_GET['id']);
        $sucesso = true;
    }

    $dado = $anuncio->obterAnuncio($_GET['id']);

    require './classes/Categoria.php';
    $categoria = new Categoria;
    $categorias = $categoria->obterLista();

    require './pages/header.php';

    require './pages/editar-anuncio.php';

    require './pages/footer.php';
