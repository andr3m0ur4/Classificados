<?php

    class Anuncio
    {
        public function obterMeusAnuncios()
        {
            global $pdo;
            $dados = [];

            $sql = "SELECT anuncios.*, anuncios_imagens.url as url FROM anuncios
                LEFT JOIN anuncios_imagens ON anuncios_imagens.id_anuncio = anuncios.id
                WHERE id_usuario = :id_usuario
            ";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':id_usuario', $_SESSION['login']);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $dados = $sql->fetchAll(PDO::FETCH_OBJ);
            }

            return $dados;
        }

        public function obterAnuncio($id)
        {
            global $pdo;
            $dado = [];

            $sql = "SELECT * FROM anuncios WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $dado = $sql->fetch(PDO::FETCH_OBJ);
            }

            return $dado;
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

        public function editarAnuncio($titulo, $categoria, $valor, $descricao, $estado, $id)
        {
            global $pdo;

            $sql = "UPDATE anuncios SET
                    titulo = :titulo,
                    id_categoria = :id_categoria,
                    id_usuario = :id_usuario,
                    valor = :valor,
                    descricao = :descricao,
                    estado = :estado
                WHERE id = :id
            ";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':titulo', $titulo);
            $sql->bindValue(':id_categoria', $categoria);
            $sql->bindValue(':id_usuario', $_SESSION['login']);
            $sql->bindValue(':descricao', $descricao);
            $sql->bindValue(':valor', $valor);
            $sql->bindValue(':estado', $estado);
            $sql->bindValue(':id', $id);
            $sql->execute();
        }

        public function excluirAnuncio($id)
        {
            global $pdo;

            $sql = "DELETE FROM anuncios_imagens WHERE id_anuncio = :id_anuncio";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':id_anuncio', $id);
            $sql->execute();

            $sql = "DELETE FROM anuncios WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();
        }
    }
