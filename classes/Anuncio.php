<?php

    class Anuncio
    {
        public function obterUltimosAnuncios($pagina, $qtd)
        {
            global $pdo;
            $offset = ($pagina - 1) * $qtd;
            $dados = [];

            $sql = "SELECT 
                    anuncios.*,
                    categorias.nome AS categoria,
                    (SELECT url FROM anuncios_imagens WHERE id_anuncio = anuncios.id LIMIT 1) AS url
                FROM anuncios
                INNER JOIN categorias ON categorias.id = anuncios.id_categoria
                ORDER BY anuncios.id DESC
                LIMIT $offset, $qtd
            ";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $dados = $sql->fetchAll(PDO::FETCH_OBJ);
            }

            return $dados;
        }
        public function obterMeusAnuncios()
        {
            global $pdo;
            $dados = [];

            $sql = "SELECT
                    *,
                    (SELECT url FROM anuncios_imagens WHERE id_anuncio = anuncios.id LIMIT 1) AS url
                FROM anuncios
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
            $dado = new stdClass();

            $sql = "SELECT anuncios.*, categorias.nome AS categoria, usuarios.telefone AS telefone
                FROM anuncios
                INNER JOIN categorias ON categorias.id = anuncios.id_categoria
                INNER JOIN usuarios ON usuarios.id = anuncios.id_usuario
                WHERE anuncios.id = :id
            ";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $dado = $sql->fetch(PDO::FETCH_OBJ);
                $dado->fotos = $this->obterFotos($id);
            }

            return $dado;
        }

        public function obterTotalAnuncios()
        {
            global $pdo;

            $sql = "SELECT COUNT(*) AS contador FROM anuncios";
            $sql = $pdo->query($sql);
            $total = $sql->fetch(PDO::FETCH_OBJ)->contador;

            return $total;
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

        public function editarAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $id)
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

            if (count($fotos) > 0) {
                $this->salvarFotos($fotos, $id);
            }
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

        private function salvarFotos($fotos, $id)
        {
            for ($i = 0; $i < count($fotos['name']); $i++) {
                $tipo = $fotos['type'][$i];

                if (in_array($tipo, ['image/jpeg', 'image/png'])) {
                    $tmpname = md5(time() . rand(0, 9999)) . '.jpg';
                    $path = "./assets/images/anuncios/{$tmpname}";
                    move_uploaded_file($fotos['tmp_name'][$i], $path);

                    list($width_original, $height_original) = getimagesize($path);
                    $ratio = $width_original / $height_original;

                    $width = 500;
                    $height = 500;

                    if ($width / $height > $ratio) {
                        $width = $height * $ratio;
                    } else {
                        $height = $width / $ratio;
                    }

                    $image = imagecreatetruecolor($width, $height);

                    if ($tipo == 'image/jpeg') {
                        $original = imagecreatefromjpeg($path);
                    } else if ($tipo == 'image/png') {
                        $original = imagecreatefrompng($path);
                    }

                    imagecopyresampled($image, $original, 0, 0, 0, 0, $width, $height, $width_original, $height_original);

                    imagejpeg($image, $path, 80);

                    global $pdo;
                    $sql = "INSERT INTO anuncios_imagens (id_anuncio, url) VALUES (:id_anuncio, :url)";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(':id_anuncio', $id);
                    $sql->bindValue(':url', $tmpname);
                    $sql->execute();
                }
            }
        }

        private function obterFotos($id)
        {
            global $pdo;
            $fotos = new stdClass();

            $sql = "SELECT id, url FROM anuncios_imagens WHERE id_anuncio = :id_anuncio";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':id_anuncio', $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $fotos = $sql->fetchAll(PDO::FETCH_OBJ);
            }

            return $fotos;
        }

        public function excluirFoto($id)
        {
            global $pdo;
            $id_anuncio = 0;

            $sql = "SELECT id_anuncio FROM anuncios_imagens WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $id_anuncio = $sql->fetch(PDO::FETCH_OBJ)->id_anuncio;
            }

            $sql = "DELETE FROM anuncios_imagens WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();

            return $id_anuncio;
        }
    }
