
<script type="text/javascript" src="<?= Theme ?>js/jquery.jcarousel.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?= Theme ?>css/jcarousel.min.css?v=<?= time() ?>" />
<div class="jumbotron box box-full">
    <div class="movie-tabs">
        <div class="contents">
            <div class="tab active" id="estrenos">
                <h3>Estrenos <?= date("Y") ?></h3>
                <div class="controles">
                    <button class="btn btn-inverse btn-sm peliculas-<?= date("Y") ?>-prev"><span class="fa fa-chevron-left"></span></button>
                    <button class="btn btn-inverse btn-sm peliculas-<?= date("Y") ?>-next"><span class="fa fa-chevron-right"></span></button>
                </div>
                <div class="jcarousel peliculas-<?= date("Y") ?>">
                    <ul>
                        <?php
                        foreach (@$peliculas2016->result()as $movie) {
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
            <div class="tab" id="azar">
                <h3>Peliculas al azar</h3>
                <div class="controles">
                    <button class="btn btn-inverse btn-sm peliculas-aleatorias-prev"><span class="fa fa-chevron-left"></span></button>
                    <button class="btn btn-inverse btn-sm peliculas-aleatorias-next"><span class="fa fa-chevron-right"></span></button>
                </div>
                <div class="jcarousel peliculas-aleatorias">
                    <ul>
                        <?php
                        foreach (@$peliculas->result()as $movie) {
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
        <div class="buttons">
            <label data-id="azar" class="title">Peliculas al azar</label>
            <label data-id="estrenos" class="title active">Estrenos <?= date("Y") ?></label>
        </div>
    </div>
</div>
<div class="jumbotron box box-full margin6em">
    <div class="header"></div>
    <div class="row">
        <div class="col-sm-9 col-left">
            <h1 class="header">Peliculas recien agregadas</h1>
            <div class="publicidad">
                <?= @$publicidad['728x90'] ?>
            </div>
            <div class="peliculas">
                <?php
                foreach (@$recientes->result() as $movie) {
                    ?>
                    <div class="item">
                        <a href="/ver/<?= $movie->p_seo ?>-<?= $movie->p_ano ?>-online.html"><img src="/files/uploads/<?= $movie->p_id ?>.jpg" alt="<?= $movie->p_titulo ?>" /></a>
                        <h2><?= $this->Master->character_limiter($movie->p_titulo, 18) ?></h2>
                        <label class="p_ano"><?= $movie->p_ano ?></label>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="publicidad">
                <?= @$publicidad['728x90'] ?>
            </div>
            <div class="paginacion">
                <?php $this->Master->Paginacion(); ?>
            </div>
        </div>
        <div class="col-sm-3 col-right">
            <form data-api="site_search" data-res="api-gral">
                <input name="q" class="header buscar" placeholder="Buscar pelicula" />
            </form>
            <h3>Generos</h3>
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
            <h3>Año de estreno</h3>
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
            <h3>Las +20 Vistas</h3>
            <div class="nano">
                <ul class="nano-content categoria">
                    <?php
                    foreach ($top20->result() as $movie) {
                        ?>
                        <li>
                            <span class="fa fa-diamond"></span>
                            <a href="/ver/<?= $movie->p_seo ?>-<?= $movie->p_ano ?>-online.html"><?= $this->Master->character_limiter($movie->p_titulo, 25) ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="publicidad">
                <?= @$publicidad['120x600'] ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        TotalPlay.CreateJCarousel('peliculas-<?= date("Y") ?>');
        TotalPlay.CreateJCarousel('peliculas-aleatorias');
        $(".movie-tabs .buttons .title").click(function () {
            var id = $(this).data('id');
            $(".movie-tabs .buttons .title").removeClass("active");
            $(this).addClass("active");
            if (id != '') {
                $('.movie-tabs .contents .tab').removeClass("active");
                $('#' + id).addClass("active");
            }
        });
    });
</script>