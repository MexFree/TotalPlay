<?php
if (@$tp_user->u_hash != '') {
    ?>
    <div class="jumbotron box margin2em">
        <h3 class="page-header">Modo Mantenimiento: Cambiar Configuracion</h3>
        <form data-api="site_update" data-res="api-site">
            <div class="input-group">
                <input type="hidden" name="w_id" value="<?= @$config->w_id ?>" />
                <span class="input-group-addon">Mantenimiento</span>
                <select class="form-control" name="w_offline" id="w_offline">
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-inverse">Guardar Cambios</button>
        </form>
        <div class="api-site"></div>
        <script>
            $(function () {
                try {
                    $("#w_offline").val(<?= @$config->w_offline ?>);
                } catch (error) {
                    alert(error);
                }
            });
        </script>
    </div>
    <?php
} else {
    ?>
    <div class="jumbotron box box-full margin2em">
        <img src="<?= Theme ?>image/offline.png" height="350" width="100%" />
    </div>
    <?php
}
?>