<?php
session_start();
include 'config.php';
include 'socialnetwork-lib.php';

ini_set('error_reporting', 0);

if (! isset($_SESSION['email'])) {

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
	name="viewport">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>FaceDave</title>

<link REL="SHORTCUT ICON" HREF="images/icon.ico" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" type="text/css" href="css/component.css" />

<script>(function(e,t,n){
		 var r=e.querySelectorAll("html")[0];
		 r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})
		 (document,window,0);
	 </script>

<script type="text/javascript">    
         function validateKeys(e) {

             key = (document.all) ? e.keyCode : e.which;
             if (key==8) return true;
             if (key==9) return true;
             if (key==11) return true;

             patron = /[A-Za-zÃ±!#$%&()=?Â¿Â¡*+0-9-_Ã¡-ÃºÃ�-Ãš :;,.]/;
         
             te = String.fromCharCode(key);
            
            return patron.test(te);
        } 
    </script>

<!-- Scroll -->
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
	</script>

<script src="js/jquery.jscroll.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

 <?php  echo Headerb (); ?> 

 <?php  echo Side (); ?>



	<div class="content-wrapper">

			<!-- Main content -->
			<section class="content">


				<!-- Main row -->
				<div class="row">
					<!-- Left col -->
					<div class="col-md-8">
						<!-- /.box -->
						<div class="row">

							<div class="col-md-12">
								<div class="box box-primary direct-chat direct-chat-warning">
									<div class="box-header with-border">
										<h3 class="box-title">What do you think today?</h3>


										<button type="button" class="btn btn-box-tool"
											data-widget="collapse">
											<i class="fa fa-minus"></i>
										</button>
									</div>

									<!-- /.box-body -->
									<div class="box-footer">
										<form action="" method="post" enctype="multipart/form-data">
											<div class="input-group">
												<textarea name="publication"
													onkeypress="return validateKeys(event)"
													placeholder="What do you think today?" class="form-control"
													cols="200" rows="3" required></textarea>
												<br> <br> <br> <br> <input type="file" name="picture"
													id="file-1" class="inputfile inputfile-1"
													data-multiple-caption="{count} files selected" /> <label
													for="file-1"><svg xmlns="http://www.w3.org/2000/svg"
														width="20" height="17" viewBox="0 0 20 17">
														<path
															d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" /></svg>
													<span>Share a photo</span></label>
												<!-- END Input file nuevo diseÃ±o .-->
												<br>

												<button type="submit" name="post"
													class="btn btn-primary btn-flat">Post</button>
											</div>
										</form>
                 <?php

                if (isset($_POST['post'])) {

                    $publication = $_POST['publication'];
                    $dateRegistration =  date('Y/m/d H:i:s');
                    $alea = substr(strtoupper(md5(microtime(true))), 0, 12);
                    $type = 'jpg';
                    $rfoto = $_FILES['picture']['tmp_name'];
                    
                    if (is_uploaded_file($rfoto)) {
                        
                        $name = $_SESSION['email'] .$alea. "." . $type;
                        $destino = "images/" . $name;
                        copy($rfoto, $destino);
                    
                    } else {

                        $destino = '';
                    }
                    
                    $updateResult = $collectionUsers->updateOne(
                    ['_id' =>  $_SESSION['email']],
                    [
                    '$push' => [ 'post'  => [
                    
                                 ['text' => $publication, 'imageURL' => $destino, 
                                  'datePublication' => date('Y/m/d H:i:s')
                                 ]
                                             ]
                               ]
                     
                    ]
                    );
                    
                }

                ?>            
                </div>
									<!-- /.box-footer-->
								</div>
								<!--/.direct-chat -->
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->


						<!-- codigo scroll -->
						<div class="scroll">
							<?php

    require_once 'publications.php';
    ?> 
						</div>

						<script>
            //Simple codigo para hacer la paginacion scroll
            $(document).ready(function() {
              $('.scroll').jscroll({
                loadingHtml: '<img src="images/invisible.png" alt="Loading" />'
            });
            });
            </script>



					</div>

					<div class="col-md-4">


						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Friend requests</h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<ul class="products-list product-list-in-box">

									<?php

        foreach ($_SESSION['friends'] as $value) {

            $friends[$key] = $value;

            /*
             * $amistade = mysql_query("SELECT * FROM amigos WHERE para = '" . $_SESSION['id'] . "' AND estado = '0' order by id_ami desc LIMIT 4");
             * while ($am = mysql_fetch_array($amistade)) {
             *
             * $use = mysql_query("SELECT * FROM usuarios WHERE id_use = '" . $am['de'] . "'");
             * $us = mysql_fetch_array($use);
             */
            ?>
									<li class="item">
										<div class="product-img">
											<img src="images/avatar.png; ?>" alt="Product Image">
										</div>
										<div class="product-info">
											<!--   <?php echo $value[0]; ?>
                      <a
												href="solicitud.php?action=aceptar&id=<?php #echo $am['id_ami']; ?>"><span
												class="label label-success pull-right">Aceptar</span></a> <br>
											<a
												href="solicitud.php?action=rechazar&id=<?php #echo $am['id_ami']; ?>"><span
												class="label label-danger pull-right">Rechazar</span></a> <span
												class="product-description">
												<?php echo $value[1]; ?>
                        </span>
										</div>
									</li>
									<!-- /.item -->

                <?php } ?>


              
								
								
								
								
								
								
								
								
								
								</ul>
							</div>
							<!-- /.box-body -->
							<div class="box-footer text-center">
              <?php

            // if(mysql_num_rows($amistade) > 4) { ?>
              <a href="javascript:void(0)" class="uppercase">See all the
									requests</a>
              <?php #} ?> 
            </div>
							<!-- /.box-footer -->
						</div>
						<!-- /.box -->
					</div>
					<!-- /.col -->


					<div class="col-md-4">
						<!-- USERS LIST -->
						<div class="box box-danger">
							<div class="box-header with-border">
								<h3 class="box-title">Last Registered</h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body no-padding">
								<ul class="users-list clearfix">
                  <?php

                // while ($reg = mysql_fetch_array($registrados)) {
                // ?>
   <!--                 <li><img src="avatars/<?php echo $_SESSION['avatars']; ?>"
										alt="User Image" width="100" height="200"> <a
										class="users-list-name" href="#">#<?php  echo $_SESSION['avatars'];?></a>
                }
								<!-- /.users-list -->
									<span class="users-list-date">Today</span>
									</li>  -->
                  <?php
                // $registrados = mysql_query("SELECT avatar,usuario,fecha_reg FROM usuarios order by id_use desc limit 8");
                ?>

                  </ul>
							</div>
							<!-- /.box-footer -->
						</div>
						<!--/.box -->
					</div>
					<!-- /.col -->


				</div>
				<!-- /.row -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Create the tabs -->
			<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
				<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i
						class="fa fa-home"></i></a></li>
				<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i
						class="fa fa-gears"></i></a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Home tab content -->
				<div class="tab-pane" id="control-sidebar-home-tab">
					<h3 class="control-sidebar-heading">Recent Activity</h3>
					<ul class="control-sidebar-menu">
						<li><a href="javascript:void(0)"> <i
								class="menu-icon fa fa-birthday-cake bg-red"></i>

								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

									<p>Will be 23 on April 24th</p>
								</div>
						</a></li>
						<li><a href="javascript:void(0)"> <i
								class="menu-icon fa fa-user bg-yellow"></i>

								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Frodo Updated His
										Profile</h4>

									<p>New phone +1(800)555-1234</p>
								</div>
						</a></li>
						<li><a href="javascript:void(0)"> <i
								class="menu-icon fa fa-envelope-o bg-light-blue"></i>

								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

									<p>nora@example.com</p>
								</div>
						</a></li>
						<li><a href="javascript:void(0)"> <i
								class="menu-icon fa fa-file-code-o bg-green"></i>

								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

									<p>Execution time 5 seconds</p>
								</div>
						</a></li>
					</ul>
					<!-- /.control-sidebar-menu -->

					<h3 class="control-sidebar-heading">Tasks Progress</h3>
					<ul class="control-sidebar-menu">
						<li><a href="javascript:void(0)">
								<h4 class="control-sidebar-subheading">
									Custom Template Design <span
										class="label label-danger pull-right">70%</span>
								</h4>

								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-danger"
										style="width: 70%"></div>
								</div>
						</a></li>
						<li><a href="javascript:void(0)">
								<h4 class="control-sidebar-subheading">
									Update Resume <span class="label label-success pull-right">95%</span>
								</h4>

								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-success"
										style="width: 95%"></div>
								</div>
						</a></li>
						<li><a href="javascript:void(0)">
								<h4 class="control-sidebar-subheading">
									Laravel Integration <span
										class="label label-warning pull-right">50%</span>
								</h4>

								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-warning"
										style="width: 50%"></div>
								</div>
						</a></li>
						<li><a href="javascript:void(0)">
								<h4 class="control-sidebar-subheading">
									Back End Framework <span class="label label-primary pull-right">68%</span>
								</h4>

								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-primary"
										style="width: 68%"></div>
								</div>
						</a></li>
					</ul>
					<!-- /.control-sidebar-menu -->

				</div>
				<!-- /.tab-pane -->

				<!-- Settings tab content -->
				<div class="tab-pane" id="control-sidebar-settings-tab">
					<form method="post">
						<h3 class="control-sidebar-heading">General Settings</h3>

						<div class="form-group">
							<label class="control-sidebar-subheading"> Report panel usage <input
								type="checkbox" class="pull-right" checked>
							</label>

							<p>Some information about this general settings option</p>
						</div>
						<!-- /.form-group -->

						<div class="form-group">
							<label class="control-sidebar-subheading"> Allow mail redirect <input
								type="checkbox" class="pull-right" checked>
							</label>

							<p>Other sets of options are available</p>
						</div>
						<!-- /.form-group -->

						<div class="form-group">
							<label class="control-sidebar-subheading"> Expose author name in
								posts <input type="checkbox" class="pull-right" checked>
							</label>

							<p>Allow the user to show his name in blog posts</p>
						</div>
						<!-- /.form-group -->

						<h3 class="control-sidebar-heading">Chat Settings</h3>

						<div class="form-group">
							<label class="control-sidebar-subheading"> Show me as online <input
								type="checkbox" class="pull-right" checked>
							</label>
						</div>
						<!-- /.form-group -->

						<div class="form-group">
							<label class="control-sidebar-subheading"> Turn off notifications
								<input type="checkbox" class="pull-right">
							</label>
						</div>
						<!-- /.form-group -->

						<div class="form-group">
							<label class="control-sidebar-subheading"> Delete chat history <a
								href="javascript:void(0)" class="text-red pull-right"><i
									class="fa fa-trash-o"></i></a>
							</label>
						</div>
						<!-- /.form-group -->
					</form>
				</div>
				<!-- /.tab-pane -->
			</div>
		</aside>
		<!-- /.control-sidebar -->
		<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>

	</div>
	<!-- ./wrapper -->

	<!-- Bootstrap 3.3.6 -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/app.min.js"></script>
	<!-- Sparkline -->
	<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
	<!-- SlimScroll 1.3.0 -->
	<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- JS modificar diseÃ±o input file -->
	<script src="js/custom-file-input.js"></script>
</body>
</html>
`
