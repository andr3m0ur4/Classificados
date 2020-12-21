<?php

    require './config.php';

    require './classes/Usuario.php';
    $usuario = new Usuario;
    $sucesso = null;

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = addslashes($_POST['email']);
        $senha = md5($_POST['senha']);

        if ($usuario->login($email, $senha)) {
            $sucesso = true;
        } else {
            $sucesso = false;
        }
    }

    require './pages/header.php';

    require './pages/login.php';

    require './pages/footer.php';
