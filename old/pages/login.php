<main class="container mt-3">
    <h1>Login</h1>

    <?php if (!is_null($sucesso)) : ?>
        <?php if ($sucesso) : ?>
            <span id="sucesso"></span>
        <?php else : ?>
            <div class="alert alert-danger">
                Usuários e/ou Senha inválidos!
            </div>
        <?php endif ?>
    <?php endif ?>

    <form method="POST">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>
        <button class="btn btn-outline-dark">Fazer Login</button>
    </form>
</main>