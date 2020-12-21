<?php

    require './config.php';

    if (empty($_SESSION['login'])) {
        header('Location: ./login.php');
        exit;
    }

    require './classes/Anuncio.php';
    $anuncio = new Anuncio;
    $sucesso = false;
    
    if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
        $titulo = addslashes($_POST['titulo']);
        $categoria = addslashes($_POST['categoria']);
        $valor = addslashes($_POST['valor']);
        $descricao = addslashes($_POST['descricao']);
        $estado = addslashes($_POST['estado']);

        $anuncio->adicionarAnuncio($titulo, $categoria, $valor, $descricao, $estado);
        $sucesso = true;
    }

    require './classes/Categoria.php';
    $categoria = new Categoria;
    $categorias = $categoria->obterLista();

    require './pages/header.php';

    require './pages/adicionar-anuncio.php';

    require './pages/footer.php';
