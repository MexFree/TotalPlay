
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <span class="fa fa-tv"></span><?= @$config->w_site_name ?>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="https://binbox.io/H4bBF" target="_blank"><span class="fa fa-github-square"></span>Descargar Repositorio</a></li>
                <?php
                if (@$tp_user->u_hash != '') {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-user-md"></span><?= @$tp_user->u_name ?>    
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            if (@$tp_user->u_rango > 0) {
                                ?>
                                <li><a href="/Reports"><span class="fa fa-file-text-o"></span>Reportes</a></li>
                                <li><a href="/Movies"><span class="fa fa-film"></span>Peliculas</a></li>
                                <li><a href="/Webs"><span class="fa fa-globe"></span>Web Amigas</a></li>
                                <li><a href="/Advertising"><span class="fa fa-money"></span>Publicidad</a></li>
                                <li><a href="/Configuration"><span class="fa fa-dashboard"></span>Configuracion</a></li>
                                <li role="separator" class="divider"></li>
                                <?php
                            }
                            ?>
                            <li><a href="/Logout"><span class="fa fa-power-off"></span>Cerrar sesion</a></li>
                        </ul>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="fa fa-unlock"></span>Iniciar Sesion
                        </a>
                        <div class="dropdown-menu dropdown-login">
                            <form data-res="api-user" data-api="user_login">
                                <div class="input-group">
                                    <span class="input-group-addon">usuario</span>
                                    <input class="form-control" name="u_name" required />
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">contraseña</span>
                                    <input class="form-control" type="password" name="u_password" required />
                                </div>
                                <button class="btn btn-danger btn-block">Iniciar</button>
                                <div class="api-user"></div>
                            </form>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>