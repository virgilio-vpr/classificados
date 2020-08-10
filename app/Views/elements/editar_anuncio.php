<!-- Extende essa section para o layout padrão -->
<?= $this->extend('layouts/default') ?>

<!-- Abre esta section -->
<?= $this->section('section_body') ?>

<!------------ Formulário de Cadastro --------------->

<div class="container col-10">
    <?= form_open('public/anuncios/update/' . $info['0']['id'], 'enctype="multipart/form-data"'); ?>
    <div class="container border boder-light shadow py-4 px-5 my-4 bg-light rounded">

        <?php if (!empty($msg) && ($st == "0" || $st == '3' || $st == '6')) : ?>
            <h4 class="alert alert-success py-2">
                <div>
                    <i class="fa fa-check-square" aria-hidden="true"></i>&nbsp;&nbsp;<?= $msg; ?>
                </div>
            </h4>
        <?php elseif (!empty($msg) && ($st >= "1" && $st <= "5") && $st != '3' && $st != '4' && $st != '6') : ?>
            <h4 class="alert alert-warning py-2">
                <div>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;<?= $msg; ?>
                </div>
            </h4>
        <?php elseif (!empty($msg) && $st == '4') : ?>
            <h4 class="alert alert-danger py-2">
                <div>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;<?= $msg; ?>
                </div>
            </h4>
        <?php else : ?>
            <h4 class="alert alert-primary py-2">
                <div>
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Editar Anúncio.
                </div>
            </h4>
        <?php endif; ?>

        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" class="form-control">
                <?php foreach ($cats as $cat) : ?>
                    <option value="<?= $cat->id; ?>" <?= ($info['0']['id_categoria'] == $cat->id) ? 'selected = "selected"' : ''; ?>><?= $cat->nome; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?= $info['0']['titulo']; ?>">
        </div>

        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" class="form-control" value="<?= number_format($info['0']['valor'], 2, ',', '.'); ?>">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control"><?= $info['0']['descricao']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="estado">Estado de Conservação:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0" <?= ($info['0']['estado'] == '0') ? 'selected = "selected"' : ''; ?>>Ruim</option>
                <option value="1" <?= ($info['0']['estado'] == '1') ? 'selected = "selected"' : ''; ?>>Bom</option>
                <option value="2" <?= ($info['0']['estado'] == '2') ? 'selected = "selected"' : ''; ?>>Ótimo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="add_fotos">Foto dos Anúncios:</label>
            <div class="">
                <input type="file" class="btn btn-secondary" name="fotos[]" multiple id="add_fotos">
            </div>
        </div>
        <div class="form-group card mt-4">
            <div class="card-header">Fotos do Anúncio</div>
            <div class="card-body d-flex justify-content-around flex-wrap">
                <?php foreach ($info['fotos'] as $foto) : ?>
                    <div class="foto_item d-flex align-content-center justify-content-center flex-wrap bg-">
                        <img src="<?= site_url($foto['url_foto']); ?>" class="img-thumbnail" border="0">
                        <a href="<?= site_url('public/anuncios/excluir_foto/') . $foto['id'] ?>" class="btn btn-danger">Excluir Imagem</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group d-flex justify-content-between">
            <input type="submit" value="Salvar" class="btn btn-primary px-5">
            <a class="btn btn-outline-secondary " href="<?= site_url('public/anuncios/index'); ?>">Meus Anúncios</a>
        </div>
    </div>
    </form>
</div>

<!-- Fecha esta section -->
<?= $this->endSection() ?>