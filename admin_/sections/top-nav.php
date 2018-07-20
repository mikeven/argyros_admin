<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="images/img.jpg" alt="">
            <?php echo $uargyros["first_name"]." ".$uargyros["last_name"]; ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <!-- <li><a href="javascript:;"> Perfil</a></li> -->
            <li><a href="home.php?logout"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
          </ul>
        </li>

        <li role="presentation" class="dropdown hidden">
          <a href="javascript:;" class="dropdown-toggle info-number" 
          data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
            <span class="badge bg-green">1</span>
          </a>
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <li>
              <a>
                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                <span>
                  <span><?php echo $uargyros["first_name"]." ".$uargyros["last_name"]; ?></span>
                  <span class="time">3 mins ago</span>
                </span>
                <span class="message">
                  Texto de mensaje
                </span>
              </a>
            </li>
            <li>
              <div class="text-center">
                <a>
                  <strong>Ver todos los mensajes</strong>
                  <i class="fa fa-angle-right"></i>
                </a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->