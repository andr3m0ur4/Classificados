<?php

    require './config.php';

    require './classes/Usuario.php';
    $usuario = new Usuario;
    $erro = false;
    $sucesso = null;

    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = $_POST['senha'];
        $telefone = addslashes($_POST['telefone']);

        if (!empty($email) && !empty($nome) && !empty($senha)) {
            if ($usuario->cadastrar($nome, $email, $senha, $telefone)) {
                $sucesso = true;
            } else {
                $sucesso = false;
            }
        } else {
            $erro = true;
        }
    }

    require './pages/header.php';

    require './pages/cadastre-se.php';

    require './pages/footer.php';
