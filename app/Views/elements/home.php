<!-- Extende essa section para o layout padrão -->
<?= $this->extend('layouts/default') ?>

<!-- Abre esta section -->
<?= $this->section('section_body'); ?>
<p><?= session()->usuario ?></p>

<!------------------------------------------------- Jumbotrom --------------------------------------------->
<div class="container-fluid mt-3">
    <div class="jumbotron">
        <h2>Existem <?= $qt_anuncios; ?> anúncios.</h2>
        <p>de <?= (isset($qt_users) && !empty($qt_users))? $qt_users : '0'; ?> usuários cadastrados.</p>
    </div>
    <div class="row">
        <!------------------------------------- Pesquisa de anuncios ---------------------------------------->
        <div class="col-sm-3">
            <h4>Pesquisa Avançada</h4>
            <?= form_open('public/main'); ?>
            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <select id="categoria" name="filtros[categoria]" class="form-control">
                    <option value="" <?= (empty($filtros['categoria'])) ? 'selected' : ''; ?>></option>
                    <?php foreach ($categorias as $cat) : ?>
                        <option value="<?= $cat->id; ?>" <?= ($cat->id == $filtros['categoria']) ? 'selected' : ''; ?>><?= $cat->nome ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="preco">Preço:</label>
                <select id="preco" name="filtros[preco]" class="form-control">
                    <option value="" <?= (empty($filtros['preco'])) ? 'selected' : ''; ?>></option>
                    <option value="0-50" <?= ($filtros['preco'] == '0-50') ? 'selected' : ''; ?>>R$ 0 - 50</option>
                    <option value="51-100" <?= ($filtros['preco'] == '51-100') ? 'selected' : ''; ?>>R$ 51 - 100</option>
                    <option value="101-200" <?= ($filtros['preco'] == '101-200') ? 'selected' : ''; ?>>R$ 101 - 200</option>
                    <option value="201-500" <?= ($filtros['preco'] == '201-500') ? 'selected' : ''; ?>>R$ 201 - 500</option>
                    <option value="501-1000" <?= ($filtros['preco'] == '501-1000') ? 'selected' : ''; ?>>R$ 501 - 1000</option>
                </select>
            </div>
            <div class="form-group">
                <label for="estado">Estado de conservação:</label>
                <select id="estado" name="filtros[estado]" class="form-control">
                    <option value="" <?= (empty($filtros['estado'])) ? 'selected' : ''; ?>></option>
                    <option value="0" <?= ($filtros['estado'] == '0') ? 'selected' : ''; ?>>Ruim</option>
                    <option value="1" <?= ($filtros['estado'] == '1') ? 'selected' : ''; ?>>Bom</option>
                    <option value="2" <?= ($filtros['estado'] == '2') ? 'selected' : ''; ?>>Ótimo</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Buscar">
            </div>
            </form>
        </div>

        <!------------------------ Exibe so últimos anuncios dá página inicial/pesquisas ---------------------------->
        <div class="col-sm-9">
            <h4>Últimos Anúncios</h4>
            <table class="table table-striped mt-3">
                <tbody>
                    <?php foreach ($ult_anuncios as $anuncio) : ?>
                        <tr>
                            <td class="align-middle text-center">
                                <?php if (!empty($anuncio->url_foto)) : ?>
                                    <img src="<?= site_url($anuncio->url_foto); ?>" height="70" border"0">
                                <?php else : ?>
                                    <img class="rounded" src="<?= base_url('public/assets/images/default.jpg'); ?>" height="50" border"0">
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('public/produto/index/' . $anuncio->id); ?>"><?= $anuncio->titulo; ?></a><br>
                                <?= $anuncio->categoria; ?>
                            </td>
                            <td class="align-middle text-right">
                                R$ <?= number_format($anuncio->valor, 2, ',', '.'); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>

            <!-- ---------------------------- Páginação da exibição de anuncios ------------------------------------------>
            <ul class="pagination justify-content-left">
                <li class="page-item <?= $resVal = (($p - 1) > 0) ? '' : 'disabled'; ?>">
                    <a class="page-link" href="<?= site_url('public/main/index/') . $resVal = (($p - 1) > 0) ? $p - 1 : $p; ?>" tttttttttttttttttttt>Anterior</a>
                </li>
                </li>
                <?php for ($q = 1; $q <= $total_paginas; $q++) : ?>
                    <li <?= $resVal = ($p == $q) ? 'class="page-item active" aria-current="page"' : 'class="page-item"'; ?>>
                        <a class="page-link" href="<?= site_url('public/main/index/') . $q; ?>">
                            <?= $q; ?><?= $resVal = ($p == $q) ? '<span class="sr-only">(current)</span>' : ''; ?>
                        </a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $resVal = (($p + 1) <= $total_paginas) ? '' : 'disabled'; ?>">
                    <a class="page-link" href="<?= site_url('public/main/index/') . $resVal = (($p + 1) <= $total_paginas) ? $p + 1 : $p; ?>">Próximo</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Fecha esta section -->
<?= $this->endSection() ?>