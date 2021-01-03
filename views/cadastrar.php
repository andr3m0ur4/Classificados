<main class="container mt-3">
    <h1>Cadastre-se</h1>

    <?php if ($erro) : ?>
        <div class="alert alert-warning">
            Preencha todos os campos!
        </div>
    <?php endif ?>

    <?php if (!is_null($sucesso)) : ?>
        <?php if ($sucesso) : ?>
            <div class="alert alert-success">
                <strong>Parabéns!</strong> Cadastrado com sucesso.
                <a href="/login" class="alert-link">Faça o login agora</a>
            </div>
        <?php else : ?>
            <div class="alert alert-warning">
                Este usuário já existe!
                <a href="/login" class="alert-link">Faça o login agora</a>
            </div>
        <?php endif ?>
    <?php endif ?>

    <form method="POST">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="tel" name="telefone" id="telefone" class="form-control">
        </div>
        <button class="btn btn-outline-dark">Cadastrar</button>
    </form>
</main>