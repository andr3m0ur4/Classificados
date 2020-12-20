<?php

    require './config.php';

    require './classes/Usuario.php';
    $usuario = new Usuario;
    $erro = false;

    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = $_POST['senha'];
        $telefone = addslashes($_POST['telefone']);

        if (!empty($email) && !empty($nome) && !empty($senha)) {
            
        } else {
            $erro = true;
        }
    }

    require './pages/header.php';

    require './pages/cadastre-se.php';

    require './pages/footer.php';