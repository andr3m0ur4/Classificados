<?php

    require './config.php';

    require './classes/Anuncio.php';
    require './classes/Usuario.php';
    $anuncio = new Anuncio;
    $usuario = new Usuario;

    $total_anuncios = $anuncio->obterTotalAnuncios();
    $total_usuarios = $usuario->obterTotalUsuarios();

    $pagina = 1;

    if (isset($_GET['p']) && !empty($_GET['p'])) {
        $pagina = addslashes($_GET['p']);
    }
    $qtd_itens = 4;
    $total_paginas = ceil($total_anuncios / $qtd_itens);

    $anuncios = $anuncio->obterUltimosAnuncios($pagina, $qtd_itens);

    require './pages/header.php';

    require './pages/index.php';

    require './pages/footer.php';
