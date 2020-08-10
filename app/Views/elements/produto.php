<!-- Extende essa section para o layout padrão -->
<?= $this->extend('layouts/default') ?>

<!-- Abre esta section -->
<?= $this->section('section_body'); ?>
<p><?= session()->usuario ?></p>

<!----------------------- Exive detalhes do produto enunciado -------------------------->
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-sm-5">
            <!---------------------------- Carousel de fotos -------------------------->
            <div class="carousel slide" data-ride="carousel" id="meuCarousel">
                <div class="carousel-inner">

                    <?php if (empty($info['fotos'])): ?>
                        <div class="carousel-item active">
                            <img src="http://via.placeholder.com/500/CCCCCC/000000" class="d-block w-100">
                        </div>
                    <?php endif; ?>

                    <?php foreach ($info['fotos'] as $chave => $foto) : ?>
                        <div class="carousel-item <?= ($chave == 0) ? 'active' : ''; ?>">
                            <img src="<?= site_url($foto['url_foto']); ?>" class="d-block w-100">
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="#meuCarousel" class="carousel-control-prev" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a href="#meuCarousel" class="carousel-control-next" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-sm-7">
            <h1><?= $info['0']['titulo']; ?></h1>
            <h4><?= $info['0']['categoria']; ?></h1>
            <p><?= $info['0']['descricao']; ?></h1>
            <br>
            <h3>R$ <?= number_format($info['0']['valor'], 2, ',', '.'); ?></h1>
            <h4>telefone: <?= $info['0']['telefone']; ?></h1>
        </div>
    </div>
</div>

<!-- Fecha esta section -->
<?= $this->endSection() ?>