<style type="text/css">
  .top_nav .dropdown-menu li a {
    width: 100%;
    padding: 12px 20px;
}
</style>
<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <nav class="nav navbar-nav">
        <ul class=" navbar-right">
          <li class="nav-item dropdown open" style="padding-left: 15px;">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="images/argyros-a.png" alt="">
              <?php echo $uargyros["first_name"]." ".$uargyros["last_name"]; ?>
              <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              <!-- <li><a href="javascript:;"> Perfil</a></li> -->
              <li>
                <a class="dropdown-item"href="home.php?logout">
                  <i class="fa fa-sign-out pull-right"></i> Salir
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
  </div>
</div>
<!-- /top navigation -->