<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html"><img src="images/alogo.png" width="160px"></a>
    </div>
    <!-- /.navbar-header -->

    <?php include("user-profile.php"); ?>
    
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                
                <li>
                    <a href="#!"><i class="fa fa-dashboard fa-fw"></i>Inicio</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-barcode fa-fw"></i>Productos<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="flot.html">Productos</a>
                        </li>
                        <li>
                            <a href="morris.html">Categorías</a>
                        </li>
                        <li>
                            <a href="morris.html">Subcategorías</a>
                        </li>
                        <li>
                            <a href="morris.html">Líneas</a>
                        </li>
                        <li>
                            <a href="morris.html">Países</a>
                        </li>
                        <li>
                            <a href="#">Propiedades<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="#">Materiales</a>
                                </li>
                                <li>
                                    <a href="#">Baños</a>
                                </li>
                                <li>
                                    <a href="#">Colores</a>
                                </li>
                                <li>
                                    <a href="#">Tallas</a>
                                </li>
                                <li>
                                    <a href="#">Trabajos</a>
                                </li>
                            </ul>
                            <!-- /.nav-third-level -->
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-book   fa-fw"></i>Clientes<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="flot.html"><i class="fa fa-th-list fa-fw"></i>Consultar clientes</a>
                        </li>
                        <li>
                            <a href="flot.html"><i class="fa fa-th-list fa-fw"></i>Agregar clientes</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="forms.html"><i class="fa fa-file-text-o   fa-fw"></i>Pedidos</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i>Usuarios<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active">
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Roles<span class="fa arrow"></span></a>
                        </li>
                        <li>
                            <a href="panels-wells.html">Grupos</a>
                        </li>
                        <li>
                            <a href="buttons.html">Todos</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li class="active">
                    <a href="#"><i class="fa fa-gear"></i> Configuración<span class="fa arrow"></span></a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>