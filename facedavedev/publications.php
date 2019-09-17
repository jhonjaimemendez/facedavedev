<?php
include 'config.php';
?>
<script type="text/javascript" src="js/likes.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $(".enviar-btn").keypress(function(event) {

      if ( event.which == 13 ) {

        var getpID =  $(this).parent().attr('id').replace('record-','');

        var usuario = $("input#usuario").val();
        var comentario = $("#comentario-"+getpID).val();
        var publicacion = getpID;
        var avatar = $("input#avatar").val();
        var nombre = $("input#nombre").val();
        var now = new Date();
        var date_show = now.getDate() + '-' + now.getMonth() + '-' + now.getFullYear() + ' ' + now.getHours() + ':' + + now.getMinutes() + ':' + + now.getSeconds();

        if (comentario == '') {
            alert('Debes añadir un comentario');
            return false;
        }

        var dataString = 'usuario=' + usuario + '&comentario=' + comentario + '&publicacion=' + publicacion;

        $.ajax({
                type: "POST",
                url: "agregarcomentario.php",
                data: dataString,
                success: function() {
                    $('#nuevocomentario'+getpID).append('<div class="box-comment"><img class="img-circle img-sm" src="avatars/'+ avatar +'"><div class="comment-text"><span class="username"> '+ nombre +'<span class="text-muted pull-right">' + date_show + '</span></span>' + comentario + '</div></div>');
                }
        });
        return false;
      }
    });

});
</script>

<?php

    $numRowsShow=5;
    
    $compag         =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
    
    $cursor = $collectionUsers->find(['$or' => 
                                     [
                                        ['_id' => $_SESSION['email']],
                                        ['friends' => ['user' => $_SESSION['email']]]
                                     ],
     ]);
    
    
   
  
    foreach ($cursor  as $doc) {
        echo 'publications publications';
        
        foreach($doc['publications'] as $key => $value) {
            
            $datePublications = $value['datePublication'];
            $multimediaurl = $value['multimediaurl'];
            $text  = $value['text'];
            $likes = $value['likes'];
            $nolikes = '0';
            $numComment =  '0';
        	?>
	<!-- START PUBLICACIONES -->
          <!-- Box Comment -->
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="avatars/<?php echo $doc['profilePicture']; ?>" alt="User Image">
                <span class="description" onclick="location.href='profile.php?id=<?php echo $doc['_id'];?>';" style="cursor:pointer; color: #3C8DBC;""><?php echo $doc['names'];?></span>
                <span class="description"><?php echo $datePublications;?></span>
               </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->
              <p><?php echo $text;?></p>

              <?php 
              if(!empty($multimediaurl)) {
              ?>
              <img src="<?php echo $multimediaurl;?>" width="100%">
              <?php
          	  }
          	  ?>

              <br><br>
              <?php 
              #$numcomen = mysql_num_rows(mysql_query("SELECT * FROM comentarios WHERE publicacion = '".$lista['id_pub']."'"));
              ?>
              <!-- Social sharing buttons -->
            <ul class="list-inline">

              <?php
              #$query = mysql_query("SELECT * FROM likes WHERE post = '".$lista['id_pub']."' AND usuario = ".$_SESSION['id']."");

              #if (mysql_num_rows($query) == 0) { ?>

                <li><div class="btn btn-default btn-xs like" id="<?php echo $likes; ?>"><i class="fa fa-thumbs-o-up"></i> I like it </div><span id="likes_<?php echo $likes; ?>"> (<?php echo $likes; ?>)</span></li>

              <?php #} else { ?>
                
                <li><div class="btn btn-default btn-xs like" id="<?php echo $nolikes; ?>"><i class="fa fa-thumbs-o-up"></i> I do not like </div><span id="likes_<?php echo $nolikes; ?>"> (<?php echo $nolikes; ?>)</span></li>

              <?php #} ?>



                    <li class="pull-right">
                      <span href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (<?php echo $numComment; ?>)</span></li>
                  </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer box-comments">

            <?php 
            #$comentarios = mysql_query("SELECT * FROM comentarios WHERE publicacion = '".$lista['id_pub']."' ORDER BY id_com desc LIMIT 2");
            #while($com=mysql_fetch_array($comentarios)){
             # $usuarioc = mysql_query("SELECT * FROM usuarios WHERE id_use = '".$com['usuario']."'");
             # $usec = mysql_fetch_array($usuarioc);
              ?>


              <div class="box-comment">
                <!-- User image -->
                <img class="img-circle img-sm" src="avatars/<?php #echo $usec['avatar'];?>">

                <div class="comment-text">
                      <span class="username">
                        <?php #echo $usec['usuario'];?>
                        <span class="text-muted pull-right"><?php #echo $com['fecha'];?></span>
                      </span><!-- /.username -->
                  <?php #echo $com['comentario'];?>
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
              <?php #} ?>

              <?php #if ($numcomen > 2) { ?> 
              <br>
                <center><span onclick="location.href='publicacion.php?id=<?php #echo $lista['id_pub'];?>';" style="cursor:pointer; color: #3C8DBC;">Ver todos los comentarios</span></center>
              <?php } } ?>

              <div id="nuevocomentario<?php  #echo $lista['id_pub'];?>"></div>
              <br>
                <form method="post" action="">
                <label id="record-<?php  #echo $lista['id_pub'];?>">
                <input type="text" class="enviar-btn form-control input-sm" style="width: 800px;" placeholder="Escribe un comentario" name="comentario" id="comentario-<?php  echo $lista['id_pub'];?>">
                <input type="hidden" name="usuario" value="<?php #echo $_SESSION['id'];?>" id="usuario">
                <input type="hidden" name="publicacion" value="<?php #echo $lista['id_pub'];?>" id="publicacion">
                <input type="hidden" name="avatar" value="<?php #echo $_SESSION['avatar'];?>" id="avatar">
                <input type="hidden" name="nombre" value="<?php #echo $_SESSION['usuario'];?>" id="nombre">
                </form>

              </div>

        </div>
        <!-- /.col -->
        <!-- END PUBLICACIONES -->
    
    <br><br>

	<?php
	#}
	//Validmos el incrementador par que no genere error
	//de consulta.  
    if($IncrimentNum<=0){}else {
	echo "<a href=\"publications.php?pag=".$IncrimentNum."\">Next</a>";
	}
?>