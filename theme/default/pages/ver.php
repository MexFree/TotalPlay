
<script type="text/javascript" src="<?= Theme ?>js/jquery.jcarousel.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?= Theme ?>css/jcarousel.min.css" />
<div class="row margin2em">
    <div class="col-sm-9 col-left">
        <div class="jumbotron box">
            <div class="row ver">
                <div class="col-sm-3 col-sm-left">
                    <img src="<?= @$config->w_imagen ?>" />
                    <button class="btn btn-danger btn-inverse btn-sm btn-block btn-report"><span class="fa fa-info-circle"></span>Reportar error</button>
                    <button class="btn btn-primary btn-inverse btn-sm btn-block btn-votos"><span class="fa fa-thumbs-o-up"></span>Me Gusta</button>
                    <div class="api-movie"></div>
                </div>
                <div class="col-sm-9 col-sm-right">
                    <h1><?= $movie->p_titulo ?></h1>
                    <a class="year" href="/year/<?= $movie->p_ano ?>"><span class="fa fa-calendar-o"></span><?= $movie->p_ano ?></a>
                    <a href="/genero/<?= $movie->g_seo ?>"><span class="fa fa-tag"></span><?= $movie->g_nombre ?></a>
                    <div class="data"><span class="fa fa-volume-up"></span><?= $movie->p_idioma ?></div>
                    <div class="data"><span class="fa fa-tv"></span><?= $movie->p_calidad ?></div>
                    <div class="data"><span class="fa fa-eye"></span><?= $movie->p_hits ?></div>
                    <div class="data"><span class="fa fa-thumbs-o-up"></span><span class="p_votos"><?= $movie->p_votos ?></span></div>
                    <div class="data"><span class="fa fa-code"></span><?= word_limiter($movie->p_sinopsis, 90) ?></div>
                </div>
            </div>
        </div>
        <div class=" jumbotron box box-full">
            <h1 class="header">Opciones Ver Online</h1>
            <div class="opciones">
                <ul class="nav nav-tabs" role="tablist">
                    <?php
                    foreach ($videos->result() as $video) {
                        ?>
                        <li class="source" data-key="<?= $this->Master->escape($video->v_source) ?>"><a href="#player" aria-controls="profile" role="tab" data-toggle="tab"><?= $video->v_titulo ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="player">
                        <div class="publicidad">
                            <?= @$publicidad['300x250'] ?>
                            <?= @$publicidad['300x250'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="header">Deja tu comentario</h1>
            <div class="fb-comments" data-colorscheme="dark" data-width="100%" data-href="<?= $config->w_url ?>" data-numposts="5"></div>
        </div>
    </div>
    <div class="col-sm-3 box-full">
        <button onclick="window.open('http://www.facebook.com/sharer.php?u=<?= $config->w_url ?>', 'Facebook', 'toolbar=0, status=0, width=650, height=450');" class="btn btn-primary btn-block btn-share"><span class="fa fa-facebook-square"></span>Share Facebook</button>
        <button onclick="window.open('https://twitter.com/intent/tweet?text=<?= ucwords($movie->p_titulo) ?>&url=<?= $config->w_url ?>', 'Twitter', 'toolbar=0, status=0, width=650, height=450');" class="btn btn-info btn-block btn-share"><span class="fa fa-twitter-square"></span>Share Twitter</button>
        <button onclick="window.open('https://plus.google.com/share?url=<?= $config->w_url ?>', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=650,width=450')" class="btn btn-danger btn-block btn-share"><span class="fa fa-google-plus-square"></span>Share Google</button>
        <div class="jumbotron box">
            <h3 class="title_cat">Generos</h3>
            <div class="nano">
                <ul class="nano-content categoria">
                    <?php
                    foreach ($generos->result() as $genero) {
                        ?>
                        <li>
                            <span class="fa fa-circle-o"></span>
                            <a href="/genero/<?= $genero->g_seo ?>"><?= $genero->g_nombre ?></a>
                            <span class="count"><?= $this->db->query("SELECT *  FROM `ms_peliculas` WHERE `p_genero` = " . $genero->g_id)->num_rows(); ?></span>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="jumbotron box">
            <h3 class=" title_cat">Año de estreno</h3>
            <div class="nano">
                <div class="nano-content categoria">
                    <?php
                    for ($i = date("Y"); $i > 1959; $i--) {
                        ?>
                        <a href="/year/<?= $i ?>" class="btn btn-info btn-inverse btn-sm"><?= $i ?></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="jumbotron box box-full box-transparent">
    <div class="movie-tabs">
        <div class="contents">
            <div class="tab active" id="estrenos">
                <h3>Peliculas Relacionadas</h3>
                <div class="controles">
                    <button class="btn btn-inverse btn-sm relacionadas-prev"><span class="fa fa-chevron-left"></span></button>
                    <button class="btn btn-inverse btn-sm relacionadas-next"><span class="fa fa-chevron-right"></span></button>
                </div>
                <div class="jcarousel relacionadas">
                    <ul>
                        <?php
                        foreach (@$relacionadas->result()as $movie) {
                            ?>
                            <li>
                                <div class="info">
                                    <a href="/ver/<?= $movie->p_seo ?>-<?= $movie->p_ano ?>-online.html"><img src="/files/uploads/<?= $movie->p_id ?>.jpg" /></a>
                                    <h5><?= $this->Master->character_limiter($movie->p_titulo, 18, '') ?></h5>
                                    <span><?= $movie->p_ano ?></span>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        TotalPlay.VerPelicula(<?= $movie->p_id ?>);
    });
</script>