<!DOCTYPE html>
<!--
Proyecto progamado por xlFederalElk0lx.
Informes coil811122@icloud.com
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name=viewport content="width=device-width, initial-scale=1"/>
        <title><?= @$config->w_titulo ?></title>
        <meta property="og:title" content="<?= @$config->w_titulo ?>" />
        <meta property="og:site_name" content="<?= @$config->w_site_name ?>"/>
        <meta property="og:url" content="<?= @$config->w_url ?>" />
        <meta property="og:description" content="<?php @$config->w_descripcion ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="<?= @$config->w_imagen ?>"/>
        <meta name="description" content="<?php @$config->w_descripcion ?>"/>
        <meta name="keywords" content="<?= @$config->w_seo ?>"/>
        <meta name="robots" content="index,follow,all"/>
        <meta name="googlebot" content="index,follow,all"/>
        <meta name="googlebot-news" content="index,follow,all">
        <meta name="google" content="translate" />

        <link type="text/css" rel="stylesheet" href="/theme/default/css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="/theme/default/css/main.css?v=<?= time() ?>" />

        <script type="text/javascript" src="/theme/default/js/jquery.min.js"></script>
        <script type="text/javascript" src="/theme/default/js/main.js?v=<?= time(); ?>"></script>
    </head>
    <body>
        <div class="container main">
        <?php $this->load->view(Pages . "navbar-top"); ?>