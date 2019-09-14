<?php

 
function Headerb () 

{
?>
<!-- START HEADER -->
<header class="main-header">


    <a href="index.php" class="logo">
      <span class="logo-lg"><b>Face</b>Dave</span>
    </a>

    <nav class="navbar navbar-static-top">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          
          <?php
             
          $rowNumPublications = $_SESSION['publications'];
          echo $rowNumPublications;
          #$noti = mysql_query("SELECT * FROM notificaciones WHERE user2 = '".$_SESSION['id']."' AND leido = '0' ORDER BY id_not desc");
          #$cuantas = mysql_num_rows($noti);
          ?>

    
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo  $rowNumPublications ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php #echo $cuantas; ?> notifications</li>
              <li>
                
                <ul class="menu">

                <?php                
                /*while($no = mysql_fetch_array($noti)) {

                $users = mysql_query("SELECT * FROM usuarios WHERE id_use = '".$no['user1']."'");
                $usa = mysql_fetch_array($users);*/
                ?>

                  <li>
                    <a href="publication.php?id=<?php #echo $no['id_pub']; ?>">
                      <i class="fa fa-users text-aqua"></i> The users <?php #echo $usa['usuario']; ?> <?php #echo $no['tipo']; ?> your post
                    </a>
                  </li>

                <?php #} ?>


                </ul>
              </li>
            </ul>
          </li>

          
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $_SESSION['avatars']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ucwords($_SESSION['names']); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $_SESSION['avatars']; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo ucwords($_SESSION['names']); ?>
                  <small>Member since <?php $_SESSION['memberyear'] ?> </small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-6 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-6 text-center">
                    <a href="#">Followed</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="editarperfil.php?id=<?php #echo $_SESSION['id'];?>" class="btn btn-default btn-flat">Edit profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign off</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
<!-- END HEADER -->
<?php
}
?>

<?php
function Side ()

{
?>
<!-- START LEFT SIDE -->
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left">
          <img src="avatars/<?php #echo $_SESSION['avatar']; ?>" width="50" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php #echo ucwords($_SESSION['usuario']); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Find your friends">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu</li>
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>News</span>
          </a>
        </li>
        <li>
          <a href="mensajes.php">
            <i class="fa fa-comment"></i> <span>Chat</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">1</small>
            </span>
          </a>
        </li>
        <li>
          <a href="index.php">
            <i class="fa fa-user"></i> <span>My Followers</span>
          </a>
        </li>
        <li>
          <a href="index.php">
            <i class="fa fa-arrow-right"></i> <span>Followed</span>
          </a>
        </li>
        <li>
          <a href="index.php">
            <i class="fa fa-heart"></i> <span>I like it</span>
          </a>
        </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<!-- END LEFT SIDE -->
<?php
}
?>