<?php

    class Anuncio
    {
        public function obterMeusAnuncios()
        {
            global $pdo;
            $dados = [];

            $sql = "SELECT anuncios.*, anuncios_imagens.url as url FROM anuncios
                LEFT JOIN anuncios_imagens ON anuncios_imagens.id_anuncio = anuncios.id
                WHERE anuncios.id = :id
            ";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':id', $_SESSION['login']);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $dados = $sql->fetchAll(PDO::FETCH_OBJ);
            }

            return $dados;
        }

        public function adicionarAnuncio($titulo, $categoria, $valor, $descricao, $estado)
        {
            global $pdo;

            $sql = "INSERT INTO anuncios (titulo, id_categoria, id_usuario, descricao, valor, estado)
                VALUES (:titulo, :id_categoria, :id_usuario, :descricao, :valor, :estado)";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':titulo', $titulo);
            $sql->bindValue(':id_categoria', $categoria);
            $sql->bindValue(':id_usuario', $_SESSION['login']);
            $sql->bindValue(':descricao', $descricao);
            $sql->bindValue(':valor', $valor);
            $sql->bindValue(':estado', $estado);
            $sql->execute();
        }
    }
