<?php

    require './config.php';

    require './classes/Anuncio.php';
    require './classes/Usuario.php';
    require './classes/Categoria.php';
    $anuncio = new Anuncio;
    $usuario = new Usuario;
    $categoria = new Categoria;

    $filtros = [
        'categoria' => '',
        'preco' => '',
        'estado' => ''
    ];

    if (isset($_GET['filtros'])) {
        $filtros = $_GET['filtros'];
    }

    $total_anuncios = $anuncio->obterTotalAnuncios($filtros);
    $total_usuarios = $usuario->obterTotalUsuarios();

    $pagina = 1;

    if (isset($_GET['p']) && !empty($_GET['p'])) {
        $pagina = addslashes($_GET['p']);
    }
    $qtd_itens = 4;
    $total_paginas = ceil($total_anuncios / $qtd_itens);

    $anuncios = $anuncio->obterUltimosAnuncios($pagina, $qtd_itens, $filtros);

    $categorias = $categoria->obterLista();

    require './pages/header.php';

    require './pages/index.php';

    require './pages/footer.php';
