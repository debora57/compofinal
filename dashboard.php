<?php include('connexion.php');
  $msg="";
  include('entete.php');
  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-compatible" content="IE=edge">
      <meta name="viewport" content="width=devise-width,initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Debora Amangoua">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
      <title>La liste des CV</title>
    </head>
    <body style="background-color: pink;">
                <?php
                  $n=1;
                  $v2="SELECT * FROM codeuses"; 
                  $repcode=mysqli_query($link,$v2);
                  while($info_code=mysqli_fetch_array($repcode)){ 
                ?>
                  
                  <div class="col-sm-6" style="text-align:justify;">
                   <center><p style="font-size: 25px;"><?php echo nl2br(htmlspecialchars($info_code['nom'])); ?> <?php echo nl2br(htmlspecialchars($info_code['prenoms'])); ?><br>Né le<br>Adresse<br>Telephone<br>Email</p></center>  
                  </div>


                  <div class="col-sm-4">
                    <h2>Resume de la codeuse</h2><br><br><br>
                    <p style="font-size: 20px;">Mes Experiences</p>
                    <p style="font-size: 20px;">Mes Diplomes</p>
                    <p style="font-size: 20px;">Mes Centres D'interets</p>
                  </div>
                  <div class="col-sm-2" >
                    <img src="upload/<?php echo htmlspecialchars($info_code['photo']);?>" style="width:150px; border-radius:100px; height:150px; float: right;">
                  </div>


                  <?php 
                  $n++;
                  } ?>
          

    </body>
  </html>
