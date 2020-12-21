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
                    <td><img src="./assets/images/anuncios/<?= $anuncio->url ?>" alt="Foto Anúncio"></td>
                    <td><?= $anuncio->titulo ?></td>
                    <td>R$ <?= number_format($anuncio->valor, 2, ',', '.') ?></td>
                    <td></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>