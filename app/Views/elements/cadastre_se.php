<!-- Extende essa section para o layout padrão -->
<?= $this->extend('layouts/default') ?>

<!-- Abre esta section -->
<?= $this->section('section_body') ?>

<!------------ Formulário de Cadastro --------------->

<div class="container col-8">

    <?= form_open('public/cadastro') ?>

    <div class="container border boder-light shadow py-4 px-5 my-4 bg-light rounded">

        <?php if (!empty($status_msg) && ($status_msg == "Preencha todos os campos!") || $status_msg == "O email já existe na base de dados!") : ?>
            <h4 class="alert alert-warning py-2 d-flex justify-content-between">
                <div>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;<?= $status_msg; ?>
                </div>
                <div>
                    <a href="<?= site_url('public/login'); ?>" style="text-decoration:none;">
                        <strong class="text-warning">Faça login agora!</strong>
                    </a>
                </div>
            </h4>
        <?php elseif (!empty($status_msg) && $status_msg == "Cadastrado realizado com sucesso!") : ?>
            <h4 class="alert alert-success py-2 d-flex justify-content-between">
                <div>
                    <i class="fa fa-check-square" aria-hidden="true"></i>&nbsp;&nbsp;<?= $status_msg; ?>
                </div>
                <div>
                    <a href="<?= site_url('public/login'); ?>" style="text-decoration:none;">
                        <strong class="text-success">Faça login agora!</strong>
                    </a>
                </div>
            </h4>
        <?php else : ?>
            <h4 class="alert alert-primary py-2 d-flex justify-content-between">
                <div>
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Formulário de cadastro de usuário.
                </div>
                <div>
                    <a href="<?= site_url('public/login'); ?>" style="text-decoration:none;">
                        <strong class="text-success">Faça login agora!</strong>
                    </a>
                </div>
            </h4>
        <?php endif; ?>

        <div class="form-group">
            <div>
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
                <input type="text" name="telefone" id="telefone" class="form-control">
            </div>

            <div class="d-flex justify-content-end mt-4">
                <input type="submit" value="Cadastrar" class="btn btn-primary">
            </div>

        </div>

        </form>
    </div>

    <!-- Fecha esta section -->
    <?= $this->endSection() ?>