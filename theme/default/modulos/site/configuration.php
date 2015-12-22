<div class="jumbotron box box-admin">
    <h1 class="page-header"><?= str_replace(@$config->w_site_name . " - ", '', @$config->w_titulo) ?></h1>
    <form data-api="site_update" data-res="api-site">
        <div class="input-group">
            <span class="input-group-addon">titulo</span>
            <input required class="form-control" value="<?= @$config->w_site_name ?>" name="w_titulo" placeholder="Nombre de tu página web" />
            <input type="hidden" name="w_id" value="<?= @$config->w_id ?>" />
        </div>
        <div class="input-group">
            <span class="input-group-addon">eslogan</span>
            <input required class="form-control" value="<?= @$config->w_slogan ?>" name="w_slogan" placeholder="Pequeña reseña de su web" />
        </div>
        <div class="input-group">
            <span class="input-group-addon">direccion</span>
            <input required class="form-control" type="url" value="<?= @$config->w_url ?>" name="w_url" placeholder="Ingresa la url donde está alojada tu web, sin la última diagonal /" />
        </div>
        <div class="input-group">
            <span class="input-group-addon">Mantenimiento</span>
            <select class="form-control" name="w_offline" id="w_offline">
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
            <span class="input-group-addon" style="max-width: 1px;"></span>
            <input required class="form-control" value="<?= @$config->w_txtoff ?>" name="w_txtoff" placeholder="Esto hará al Sitio inaccesible a los usuarios. Si quiere, también puede introducir un breve mensaje (255 caracteres) para mostra" />
        </div>
        <div class="input-group">
            <span class="input-group-addon">tema</span>
            <select class="form-control" name="w_tema" id="w_tema">
                <?php
                $temas = directory_map("./theme/", 1);

                for ($i = 0; $i < sizeof($temas); $i++) {
                    ?>
                    <option value="<?= str_replace("/", "", $temas[$i]) ?>"><?= ucfirst(str_replace("/", "", $temas[$i])) ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-inverse">Guardar Cambios</button>        
    </form>
    <div class="api-site"></div>
</div>
<script>
    $(function () {
        try {
            $("#w_offline").val(<?= @$config->w_offline ?>);
            $("#w_tema").val('<?= @$config->w_tema ?>');
        } catch (error) {
            alert(error);
        }
    });
</script>