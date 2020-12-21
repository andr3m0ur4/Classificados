<main class="container my-4">
    <h1>Meus Anúncios - Editar Anúncio</h1>

    <?php if ($sucesso) : ?>
        <div class="alert alert-success">
            Produto editado com sucesso!
        </div>
    <?php endif ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" class="form-control">
                <?php foreach ($categorias as $categoria) : ?>
                    <option value="<?= $categoria->id ?>" <?= $dado->id_categoria == $categoria->id ? 'selected' : '' ?>>
                        <?= $categoria->nome ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?= $dado->titulo ?>">
        </div>
        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" class="form-control" value="<?= $dado->valor ?>">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control"><?= $dado->descricao ?></textarea>
        </div>
        <div class="form-group">
            <label for="estado">Estado de Conservação:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0" <?= $dado->estado == 0 ? 'selected' : '' ?>>Ruim</option>
                <option value="1" <?= $dado->estado == 1 ? 'selected' : '' ?>>Bom</option>
                <option value="2" <?= $dado->estado == 2 ? 'selected' : '' ?>>Ótimo</option>
            </select>
        </div>
        <button class="btn btn-outline-dark">Salvar</button>

    </form>
</main>