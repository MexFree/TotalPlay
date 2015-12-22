<div class="jumbotron box box-admin">
    <h1 class="page-header"><?= str_replace(@$config->w_site_name . " - ", '', @$config->w_titulo) ?></h1>
    <form data-res="api-site" data-api="site_advertising">
        <div class="input-group">
            <span class="input-group-addon">Banner 728x90</span>
            <textarea required class="form-control" name="728x90"><?= @$publicidad['728x90'] ?></textarea>
        </div>
        <div class="input-group">
            <span class="input-group-addon">Banner 300x250</span>
            <textarea required class="form-control" name="300x250"><?= @$publicidad['300x250'] ?></textarea>
        </div>
        <div class="input-group">
            <span class="input-group-addon">Banner 120x600</span>
            <textarea class="form-control" name="120x600" required><?= @$publicidad['120x600'] ?></textarea>
        </div>
        <div class="input-group">
            <span class="input-group-addon">Facebook</span>
            <input class="form-control" type="url" required value="<?= @$publicidad['fb'] ?>"  name="fb" placeholder="Link de tu página me gusta en facebook"/>
        </div>
        <button type="submit" class="btn btn-inverse">Guardar Cambios</button>
    </form>
    <div class="api-site"></div>
</div>