<div class="jumbotron box box-full">
    <div class="header"></div>
    <div class="row">
        <div class="col-sm-9 col-left">
            <h1 class="header"><?= @$search->titulo ?></h1>
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
                <?php
                if ($search->g_id != '') {
                    $data = array("p_genero" => $search->g_id);
                } elseif ($search->p_ano != '') {
                    $data = array("p_ano" => $search->p_ano);
                } elseif ($search->p_titulo != '') {
                    $data = array("p_titulo" => $search->p_titulo);
                }
                $this->Master->Paginacion(3, @$data);
                ?>
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
            <div class="publicidad">
                <?= @$publicidad['120x600'] ?>
            </div>
        </div>
    </div>
</div>