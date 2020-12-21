<?php

    class Anuncio
    {
        public function obterMeusAnuncios()
        {
            global $pdo;
            $dados = [];

            $sql = "SELECT anuncios.*, anuncios_imagens.url as url FROM anuncios
                INNER JOIN anuncios_imagens ON anuncios_imagens.id_anuncio = anuncio.id
                WHERE id = :id
            ";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':id', $_SESSION['login']);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $dados = $sql->fetchAll(PDO::FETCH_OBJ);
            }

            return $dados;
        }
    }
