<header class="container-fluid">
    <div class="jumbotron">
        <h1>Nós temos <?= $total_anuncios ?> anúncios hoje.</h1>
        <p>E mais de <?= $total_usuarios ?> usuários cadastrados.</p>
    </div>
</header>

<main class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <h4>Pesquisa Avançada</h4>
        </div>
        <div class="col-sm-9">
            <h4>Últimos Anúncios</h4>

            <table class="table table-striped">
                <tbody>
                    <?php foreach ($anuncios as $anuncio) : ?>
                        <tr>
                            <td>
                                <?php if (!empty($anuncio->url)) : ?>
                                    <img src="./assets/images/anuncios/<?= $anuncio->url ?>" height="75" alt="Foto Anúncio">
                                <?php else : ?>
                                    <img src="./assets/images/default.jpg" height="75" alt="Foto Anúncio">
                                <?php endif ?>
                            </td>
                            <td>
                                <a href="./produto.php?id=<?= $anuncio->id ?>"><?= $anuncio->titulo?></a>
                                <span class="d-block"><?= $anuncio->categoria ?></span>
                            </td>
                            <td>R$ <?= number_format($anuncio->valor, 2) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <ul class="pagination justify-content-center">
                <?php for ($i = 0; $i < $total_paginas; $i++) : ?>
                    <li class="page-item <?= $pagina == $i + 1 ? 'active' : '' ?>">
                        <a class="page-link" href="./?p=<?= $i + 1 ?>"><?= $i + 1 ?></a>
                    </li>
                <?php endfor ?>
            </ul>
        </div>
    </div>
</main>