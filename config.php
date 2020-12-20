<?php

    session_start();

    try {
        $pdo = new PDO('mysql:dbname=classificados;host=localhost;charset=utf8', 'andre-moura', 'andre');
    } catch(PDOException $e) {
        die("FALHOU: {$e->getMessage()}");
    }
    