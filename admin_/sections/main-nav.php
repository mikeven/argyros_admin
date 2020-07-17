<div class="col-md-3 left_col">
<div class="left_col scroll-view">
<div class="navbar nav_title" style="border: 0;">
  <a href="home.php" class="site_title"><img src="images/alogo.png" width="160"></a>
</div>

<div class="clearfix"></div>

<?php 
  $uargyros = $_SESSION["user-adm"];
  include( "welcome-profile.php" ); 
?>

<br/>

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
      <li><a href="home.php"><i class="fa fa-home"></i>Inicio</a></li>
      <li><a><i class="fa fa-barcode fa-fw"></i>Productos <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li>
                <a href="products.php">Productos</a>
            </li>
            <li>
                <a href="categories.php">Categorías</a>
            </li>
            <li>
                <a href="subcategories.php">Subcategorías</a>
            </li>
            <li>
                <a href="lines.php">Líneas</a>
            </li>
            <li>
                <a href="sets.php">Juegos</a>
            </li>
            <li>
                <a href="catalog-report.php">Imágenes de catálogo</a>
            </li>
            <li>
                <a href="countries.php">Países</a>
            </li>

            <li><a>Propiedades <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li class="sub_menu"><a href="materials.php">Materiales</a></li>
                <li><a href="treatments.php">Baños</a></li>
                <li><a href="colors.php">Colores</a></li>
                <li><a href="sizes.php">Tallas</a></li>
                <li><a href="makings.php">Trabajos</a></li>
              </ul>
            </li>
        </ul>
      </li>
      <li><a><i class="fa fa-book fa-fw"></i>Clientes <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li>
                <a href="clients.php">Consultar clientes</a>
            </li>
            <li>
                <a href="client-groups.php"></i>Grupos</a>
            </li>
        </ul>
      </li>
      <li><a href="orders.php"><i class="fa fa-file-text-o fa-fw"></i>Pedidos</a>
      </li>
      <li>
        <a href="users.php"><i class="fa fa-users fa-fw"></i>Usuarios</a>
      </li>
      <li>
        <a href="settings.php"><i class="fa fa-gear"></i> Configuración</a>
      </li>
    </ul>
  </div>  
</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
  <a style="float:right;" data-toggle="tooltip" data-placement="top" 
    title="Salir" href="home.php?logout">
    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
  </a>
</div>
<!-- /menu footer buttons -->
</div>
</div>