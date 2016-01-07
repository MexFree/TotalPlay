<script type="text/javascript" src="<?= Theme ?>js/jquery.dataTables.min.js"></script>
<div class="jumbotron box box-admin">
    <h1 class="page-header"><?= str_replace(@$config->w_site_name . " - ", '', @$config->w_titulo) ?></h1>
    <form id="fg" data-res="api-site" data-api="site_webadd">
        <div class="input-group">
            <span class="input-group-addon">titulo</span>
            <input class="form-control" id="l_name" name="l_nombre" required placeholder="Nombre de la página web" />
        </div>
        <div class="input-group">
            <input type="hidden" id="l_id" name="l_id" value="" />
            <span class="input-group-addon">url</span>
            <input class="form-control" id="l_url" name="l_url" type="url" required placeholder="Ej: http://www.totalplay.es/" />
            <span class="input-group-addon" style="min-width: 5px;">mostrar</span>
            <select class="form-control" id="l_online" name="l_online" required>
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-inverse">Agregar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>
    <div class="api-site"></div>
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
                if (@$webs != '') {
                    foreach ($webs->result() as $row) {
                        ?>
                        <tr>
                            <td><?= $row->l_id ?></td>
                            <td><?= $row->l_nombre ?></td>
                            <td>
                                <a title="Visitar <?= ucfirst($row->l_nombre) ?>" target="_blank" href="<?= $row->l_url ?>"><span class="fa fa-eye"></span></a>
                                <a onclick="Site.WebEdit('<?= $row->l_id ?>', '<?= $row->l_nombre ?>', '<?= $row->l_url ?>', '<?= $row->l_online ?>')" href="javascript:void(0);" title="Editar <?= ucfirst($row->l_nombre) ?>"><span class="fa fa-edit"></span></a>
                                <a onclick="Site.WebDelete('<?= $row->l_id ?>')" href="javascript:void(0);" title="Borrar <?= ucfirst($row->l_nombre) ?>"><span class="fa fa-trash"></span></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <center><button class="btn btn-inverse paginate_button_add">Agregar web</button></center>
    </div>
</div>
<script>
    $(function () {
        Site.TableWebs();
    });
</script>