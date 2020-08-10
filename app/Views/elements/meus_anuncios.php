<!-- Extende essa section para o layout padrão -->
<?= $this->extend('layouts/default') ?>

<!-- Abre esta section -->
<?= $this->section('section_body') ?>

<!------------ Formulário de Login --------------->
<div class="container">
    <div class="col my-2">
        <div class="row d-flex justify-content-between d-flex align-items-center">
            <h2>Meus Anúncios</h2>
            <a href="<?= site_url('public/anuncios/cadastrar') ?>" class="btn btn-primary my-2">Adiconar Anúncio</a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="text-center">
                <th class="align-middle">Foto</th>
                <th class="align-middle">Título</th>
                <th class="align-middle">Valor</th>
                <th class="align-middle">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anuncios as $anuncio) : ?>
                <tr>
                    <td class="align-middle text-center">
                        <?php if (!empty($anuncio->url_foto)) : ?>
                            <img src="<?= site_url($anuncio->url_foto); ?>" height="70" border"0">
                        <?php else : ?>
                            <img class="rounded" src="<?= base_url('public/assets/images/default.jpg'); ?>" height="50" border"0">
                        <?php endif; ?>
                    </td>
                    <td class="align-middle"><?= $anuncio->titulo; ?></td>
                    <td class="align-middle text-right">R$ <?= number_format($anuncio->valor, 2, ',', '.'); ?></td>
                    <td class="align-middle">
                        <div class="d-flex justify-content-around">
                            <a href="<?= site_url('public/anuncios/editar/') . $anuncio->id; ?>" class="btn btn-outline-primary">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <a href="<?= site_url('public/anuncios/excluir/') . $anuncio->id; ?>" class="btn btn-outline-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<!-- Fecha esta section -->
<?= $this->endSection() ?>