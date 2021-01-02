<?php

    class Categoria
    {
        public function obterLista()
        {
            global $pdo;
            $dados = [];

            $sql = "SELECT * FROM categorias";
            $sql = $pdo->query($sql);

            if ($sql->rowCount() > 0) {
                $dados = $sql->fetchAll(PDO::FETCH_OBJ);
            }

            return $dados;
        }
    }
