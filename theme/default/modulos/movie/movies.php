
<script type="text/javascript" src="<?= Theme ?>js/jquery.dataTables.min.js"></script>
<div class="jumbotron box box-admin">
    <h1 class="page-header"><?= str_replace(@$config->w_site_name . " - ", '', @$config->w_titulo) ?></h1>
    <form id="fg" data-api="" data-res="api-movie">
        <div class="input-group">
            <span class="input-group-addon">titulo</span>
            <input required class="form-control" name="p_titulo" id="p_titulo" placeholder="Nombre de la película" />
        </div>
        <div class="input-group">
            <span class="input-group-addon">sinopsis</span>
            <textarea required name="p_sinopsis" id="p_sinopsis" class="form-control"></textarea>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon">estreno</span>
                    <select required class="form-control" id="p_estreno" name="p_estreno">
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">online</span>
                    <select required class="form-control" id="p_online" name="p_online">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">año</span>
                    <select class="form-control" id="p_ano" name="p_ano" required>
                        <?php
                        for ($i = date("Y"); $i > 1949; $i--) {
                            ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">idioma</span>
                    <select class="form-control" name="p_idioma" id="p_idioma" required>
                        <option value="castellano">Castellano</option>
                        <option value="frances">Frances</option>
                        <option value="ingles">Ingles</option>
                        <option value="japones">Japones</option>
                        <option value="koreano">Koreano</option>
                        <option value="latino">Latino</option>
                        <option value="vose">VOSE</option>
                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">calidad</span>
                    <select class="form-control" required id="p_calidad" name="p_calidad">
                        <option value="bluray">Bluray</option>
                        <option value="blurayrip">BlurayRip</option>
                        <option value="cam">Cam</option>
                        <option value="dvdscreener">DVDScreener</option>
                        <option value="dvdrip">DVDRip</option>
                        <option value="hd">HD</option>
                        <option value="telesync">TeleSync</option>
                        <option value="telesynchd">TeleSyncHD</option>
                        <option value="tvhd">TVHD</option>
                        <option value="tvrip">TVRip</option>
                        <option value="webrip">WebRip</option>
                    </select>
                </div>
                <div class="input-group">
                    <label class="input-group-addon">Genero</label>    
                    <select class="form-control" name="p_genero" id="p_genero">
                        <?php
                        foreach ($generos->result() as $row) {
                            ?>
                            <option value="<?= $row->g_id ?>"><?= $row->g_nombre ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <fieldset>
                    <legend>Caratula</legend>
                </fieldset>
                <input type="file" id="caratula" name="caratula" />
                <label class="btn btn-primary btn-block btn-sm">Seleccionar</label>
            </div>
        </div>
        <input type="hidden" value="" name="p_id" id="p_id" />
        <button type="submit" class="btn btn-inverse">Agregar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>
    <div class="api-movie"></div>
    <div class="listado">
        <table id="movie_table" class="movie_table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (@$movies->num_rows() > 0) {
                    foreach ($movies->result() as $row) {
                        @$row->p_sinopsis = str_replace("'", "\'", $row->p_sinopsis);
                        @$row->p_titulo = str_replace("'", "\'", $row->p_titulo);
                        ?>
                        <tr>
                            <td><?= @$row->p_id ?></td>
                            <td><?= ucfirst(@$row->p_titulo) ?></td>
                            <td>
                                <a title="Ver Pelicula" target="_blank" href="/ver/<?= $row->p_seo ?>-<?= $row->p_ano ?>-online.html"><span class="fa fa-eye"></span></a>
                                <a title="Editar Pelicula" onclick="Movie.Update(<?= $this->Master->Jsonencode($row) ?>)" href="javascript:void(0);"><span class="fa fa-edit"></span></a>
                                <a title="Reproductores de Pelicula" href="/Movies/Videos/<?= $row->p_id ?>"><span class="fa fa-play-circle-o"></span></a>
                                <a onclick="Movie.Delete('<?= @$row->p_id ?>');" title="Eliminar Pelicula" href="javascript:void(0)"><span class="fa fa-trash"></span></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <center><button class="btn btn-inverse paginate_button_add">Agregar pelicula</button></center>
    </div>
</div>
<script>
    $(function () {
        Movie.TableMovie();
    });
</script>