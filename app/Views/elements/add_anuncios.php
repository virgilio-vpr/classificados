<!-- Extende essa section para o layout padrão -->
<?= $this->extend('layouts/default') ?>

<!-- Abre esta section -->
<?= $this->section('section_body') ?>

<!------------ Formulário de Cadastro --------------->

<div class="container col-6">

    <?= form_open('public/anuncios/cadastrar'); ?>

    <div class="container border boder-light shadow py-4 px-5 my-4 bg-light rounded">

        <?php if (!empty($msg) && ($status_msg == "1")) : ?>
            <h4 class="alert alert-success py-2">
                <div>
                    <i class="fa fa-check-square" aria-hidden="true"></i>&nbsp;&nbsp;<?= $msg; ?>
                </div>
            </h4>
        <?php elseif (!empty($msg) && ($status_msg == "2" || $status_msg == "3")) : ?>
            <h4 class="alert alert-warning py-2">
                <div>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;<?= $msg; ?>
                </div>
            </h4>
        <?php else : ?>
            <h4 class="alert alert-primary py-2">
                <div>
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Meus Anúncios - Adiconar Novo Anúncio.
                </div>
            </h4>
        <?php endif; ?>

        <div class="form-group">
            <label for="categoria">Categoria:</label>

            <select name="categoria" id="categoria" class="form-control">
                <?php foreach ($cats as $cat) : ?>
                    <option value="<?= $cat->id; ?>"><?= $cat->nome; ?></option>
                <?php endforeach; ?>
            </select>

        </div>
                    
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control">
        </div>

        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="number" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any" name="valor" id="valor" class="form-control">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="estado">Estado de Conservação:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0">Ruim</option>
                <option value="1">Bom</option>
                <option value="2">Ótimo</option>
            </select>
        </div>
        <div class="form-group d-flex justify-content-end">
            <input type="submit" value="Adicionar" class="btn btn-primary">
        </div>
    </div>
    </form>
</div>

<!-- Fecha esta section -->
<?= $this->endSection() ?>