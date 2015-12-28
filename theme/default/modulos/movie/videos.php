<script type="text/javascript" src="<?= Theme ?>js/jquery.dataTables.min.js"></script>
<div class="jumbotron box box-admin">
    <h1 class="page-header"><?= str_replace(@$config->w_site_name . " - ", '', @$config->w_titulo) ?> <?= ucwords(@$movie->p_titulo) ?></h1>
    <form id="fg" data-res="api-movie" data-api="">
        <div class="input-group">
            <span class="input-group-addon">Idioma</span>
            <select class="form-control" name="v_titulo" id="v_titulo" required>
                <option value="castellano">Castellano</option>
                <option value="frances">Frances</option>
                <option value="ingles">Ingles</option>
                <option value="japones">Japones</option>
                <option value="koreano">Koreano</option>
                <option value="latino">Latino</option>
                <option value="vose">VOSE</option>
            </select>
            <span class="input-group-addon">online</span>
            <select required class="form-control" id="v_online" name="v_online">
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
        </div>
        <input type="hidden" name="p_id" id="p_id" value="<?= @$movie->p_id ?>"/>
        <input type="hidden" name="v_id" id="v_id" value=""/>
        <div class="input-group">
            <span class="input-group-addon">Source</span>
            <textarea required name="v_source" id="v_source" class="form-control" placeholder="Código HTML del reproductor"></textarea>
        </div>
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
                if (@$videos->num_rows() > 0) {
                    foreach ($videos->result() as $row) {
                        ?>
                        <tr>
                            <td><?= @$row->v_id ?></td>
                            <td><?= ucfirst(@$row->v_titulo) ?></td>
                            <td>
                                <a onclick='Movie.VideosUpdate(<?=  json_encode($row)?>);' title="Editar Reproductor" onclick="" href="javascript:void(0);"><span class="fa fa-edit"></span></a>
                                <a onclick="Movie.VideosDelete('<?= @$row->v_id ?>','<?= @$row->p_id ?>')" title="Eliminar Reproductor" href="javascript:void(0)"><span class="fa fa-trash"></span></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <center><button class="btn btn-inverse paginate_button_add">Agregar Reproductor</button></center>
    </div>
</div>
<script>
    Movie.TableVideos("<?= ucfirst($movie->p_titulo) ?>",<?= $movie->p_id ?>);
</script>