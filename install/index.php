
<?php $this->load->view(Theme . "header"); ?>
<style>
    body{
        text-align: right;
    }
</style>
<?php
if (@$permisos->files > 0 && @$permisos->avatar > 0 && @$permisos->uploads > 0) {
    ?>
    <div class="jumbotron box">
        <h1 class=" page-header">TotalPlay v1.0</h1>
        <p>Una web de películas - Programa de instalación</p>
        <div class="tabs">
            <form data-api="site_install" data-res="api-site">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#db" aria-controls="home" role="tab" data-toggle="tab">Base de datos</a></li>
                    <li role="presentation"><a href="#web" aria-controls="profile" role="tab" data-toggle="tab">Datos de la web</a></li>
                    <li role="presentation"><a href="#admon" aria-controls="messages" role="tab" data-toggle="tab">Administrador</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="db">
                        <p>Ingresa tus datos de conexcion a la base de datos.</p>
                        <div class="input-group">
                            <span class=" input-group-addon">Servidor</span>
                            <input required class="form-control" name="servidor" placeholder="Donde está la base de datos, ej: localhost" />
                        </div>
                        <div class="input-group">
                            <span class=" input-group-addon">usuario</span>
                            <input required class="form-control" name="db_user" placeholder="El usuario de tu base de datos." />
                        </div>
                        <div class="input-group">
                            <span class=" input-group-addon">Contraseña</span>
                            <input required class="form-control" type="password" name="db_password" placeholder="Para acceder a la base de datos." />
                        </div>
                        <div class="input-group">
                            <span class=" input-group-addon">Base de datos</span>
                            <input required class="form-control" name="db_name" placeholder="Nombre de la base de datos para tu web" />
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="web">
                        <div class="input-group">
                            <span class=" input-group-addon">nombre</span>
                            <input required class="form-control" name="nombre" placeholder="El título de tu web." />
                        </div>
                        <div class="input-group">
                            <span class=" input-group-addon">lema</span>
                            <input required class="form-control" name="lema" placeholder="Ej: Inteligencia recargada." />
                        </div>
                        <div class="input-group">
                            <span class=" input-group-addon">direccion</span>
                            <input required class="form-control" value="http://<?= $_SERVER['SERVER_NAME'] ?>" type="url" name="direccion" placeholder="Ingresa la url donde está alojada tu web, sin la última diagonal /" />
                        </div>
                        <div class="input-group">
                            <span class=" input-group-addon">email</span>
                            <input required class="form-control" value="webmaster@<?= str_replace("www.", "", $_SERVER['SERVER_NAME']) ?>" type="email" name="email" placeholder="Email de la web o del administrador." />
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="admon">
                        <p>Ingresa tus datos de usuario, más adelante debes editar tu cuenta para ingresar datos como, fecha de nacimiento, lugar de recidencia, etc.</p>
                        <div class="input-group">
                            <span class=" input-group-addon">usuario</span>
                            <input required class="form-control" name="usuario"/>
                        </div>
                        <div class="input-group">
                            <span class=" input-group-addon">Contraseña</span>
                            <input required class="form-control" type="password" name="password"/>
                        </div>
                        <div class="input-group">
                            <span class=" input-group-addon">Confirmar</span>
                            <input required class="form-control" type="password" name="re_password" placeholder="Ingresa tu contraseña nuevamente" />
                        </div>
                        <div class="input-group">
                            <span class=" input-group-addon">email</span>
                            <input required class="form-control" name="email_user" type="email" placeholder="Ingresa tu dirección de email." />
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-inverse">Instalar</button>
            </form>
        </div>
        <div class="api-site"></div>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-danger" role=alert><strong class="fa fa-warning"></strong>Los siguientes directorios requieren de permisos especiales: <strong>./files/</strong>, <strong>./files/avatar</strong>, <strong>./files/uploads</strong>. debes cambiarlos desde tu cliente FTP, los direcorios deben tener permiso 777</div>
    <a href="/" class="btn btn-inverse">Volver a verificar</a>
    <?php
}
?>
<?php $this->load->view(Theme . "footer"); ?>