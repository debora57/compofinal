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
    
          <div class="body" style="background-color:#FFF; width: 960px; margin: 10px auto; height: auto; position: relative;">
            <div class="article" style="text-align: justify; margin: 50px;">
              <h1 style="color:pink;"><center><i></i>CV DES DIFFERENTES CODEUSES</center></h1><br><br><br>
  
            <?php
                  $n=1;
                  $v2="SELECT * FROM codeuses"; 
                  $repcvliste=mysqli_query($link,$v2);
                  while($info_cvliste=mysqli_fetch_array($repcvliste)){ 
                ?>
                  
                  <div style="text-align:justify;">
                   <p style="color:blue; float: left;"><?php echo nl2br(htmlspecialchars($info_cvliste['nom'])); ?> <?php echo nl2br(htmlspecialchars($info_cvliste['prenoms'])); ?><br>Née le <?php echo nl2br(htmlspecialchars($info_cvliste['datenais'])); ?><br><?php echo nl2br(htmlspecialchars($info_cvliste['email'])); ?></p>
                    <img src="upload/<?php echo htmlspecialchars($info_cvliste['photo']);?>" style="width:150px; border-radius:100px; float:right; height:150px; ">


                    <center><h2>
                    <?php echo nl2br(htmlspecialchars($info_cvliste['specialisation'])); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($info_cvliste['resume'])); ?><br><br><br><br>
                  </p></center>
                  </div>
                  <hr>
                  <?php 
                  $n++;
                  } ?>
       </div>
    </div>

    </body>
  </html>
