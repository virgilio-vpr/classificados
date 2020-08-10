<!-- Extende essa section para o layout padrão -->
<?= $this->extend('layouts/default') ?>

<!-- Abre esta section -->
<?= $this->section('section_body') ?>

<!------------ Formulário de Login --------------->

<div class="container col-5">

    <?= form_open('public/Login') ?>

    <div class="container border boder-light shadow py-4 px-5 my-4 bg-light rounded">

        <!-------------- Menssagens do cabeçalho do Formulário ------------------>
        <?php if (!empty($status_msg) && $status_msg == "Preencha todos os campos!") : ?>
            <h4 class="alert alert-warning py-2">
                <i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;<?= $status_msg; ?>&nbsp;&nbsp;
                <a href="<?= site_url('public/login'); ?>" style="text-decoration:none;"></a>
            </h4>
        <?php elseif (!empty($status_msg) && $status_msg == "Usuário e/ou senha errados!") : ?>
            <h4 class="alert alert-danger py-2">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;<?= $status_msg; ?>&nbsp;&nbsp;
                <a href="<?= site_url('public/login'); ?>" style="text-decoration:none;"></a>
            </h4>
        <?php else : ?>
            <h4 class="alert alert-primary py-2">
                <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;Formulário de login.
            </h4>
        <?php endif; ?>

        <!---------------------- Campos do Formulário --------------------------->
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" size="50">
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control" size="15">
        </div>

        <div class="d-flex justify-content-end mt-4">
            <input type="submit" value="Login" class="btn btn-primary">
        </div>

    </div>

    </form>
</div>

<!-- Fecha esta section -->
<?= $this->endSection() ?>