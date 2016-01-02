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
        <meta property="og:description" content="<?= @$config->w_descripcion ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="<?= @$config->w_imagen ?>"/>
        <meta name="description" content="<?= @$config->w_descripcion ?>"/>
        <meta name="keywords" content="<?= @$config->w_seo ?>"/>
        <meta name="robots" content="index,follow,all"/>
        <meta name="googlebot" content="index,follow,all"/>
        <meta name="googlebot-news" content="index,follow,all">
        <meta name="google" content="translate" />

        <link type="text/css" rel="stylesheet" href="<?= Theme ?>css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="<?= Theme ?>css/nanoscroller.css" />
        <link type="text/css" rel="stylesheet" href="<?= Theme ?>css/main.css" />

        <script type="text/javascript" src="<?= Theme ?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?= Theme ?>js/main.js"></script>
    </head>
    <body>
        <div id="fb-root"></div>
        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5&appId=190118467713874";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <div class="api-gral"></div>
        <div class="container main">
            <?php $this->load->view(Pages . "navbar-top"); ?>