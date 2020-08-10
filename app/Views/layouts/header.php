<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classificados</title>

    <!-- Link arquivo de estilos icon,Bootstrap, Font-Awesome e CSS-->
    <link rel="icon" href="<?= base_url('public/assets/images/brand_icon.png'); ?>" />
    <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css'); ?>">
</head>

<body>
    <!------------------------- Cabeçalho com Brand e navbar ----------------------->
    <header class="container-fluid bg-dark">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="<?= site_url('public/main/index'); ?>">
                <img src="<?= base_url('public/assets/images/brand_icon.svg'); ?>" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                Classificados
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?php if (session()->has('id')) : ?>
                        <a class="nav-item nav-link disabled text-white">Usuário: <?= session()->get('nome') ?></a>
                        <a class="nav-item nav-link" href="<?= site_url('public/anuncios/index'); ?>">Meus Anúncios</a>;
                        <a class="nav-item nav-link" href="<?= site_url('public/main/logout'); ?>">Sair </a>
                    <?php else : ?>
                        <a class="nav-item nav-link" href="<?= site_url('public/cadastro'); ?>">Cadastre-se</a>
                        <a class="nav-item nav-link" href="<?= site_url('public/login'); ?>">Login</a>
                    <?php endif; ?>
                </div>
            </div>  
        </nav>
    </header>