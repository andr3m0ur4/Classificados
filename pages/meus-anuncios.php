<main class="container mt-4">
    <h1>Meus Anúncios</h1>

    <a href="./adicionar-anuncio.php" class="btn btn-outline-dark">Adicionar Anúncio</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Título</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anuncios as $anuncio) : ?>
                <tr>
                    <td>
                        <?php if (!empty($anuncio->url)) : ?>
                            <img src="./assets/images/anuncios/<?= $anuncio->url ?>" alt="Foto Anúncio">
                        <?php else : ?>
                            <img src="./assets/images/anuncios/default.jpg" height="75" alt="Foto Anúncio">
                        <?php endif ?>
                    </td>
                    <td><?= $anuncio->titulo ?></td>
                    <td>R$ <?= number_format($anuncio->valor, 2, ',', '.') ?></td>
                    <td>
                        <a href="./editar-anuncio.php?id=<?= $anuncio->id ?>" class="btn btn-primary">Editar</a>
                        <a href="./excluir-anuncio.php?id=<?= $anuncio->id ?>" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>