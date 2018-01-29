<?php include ('connexion.php') ?>
<?php include('entete.php');

$msg="";
    if(isset($_POST['btnValider'])) {
        $sql="INSERT INTO codeuses (nom,prenoms,datenais,photo,specialisation,email,mdp,resume) 
        VALUES ('".mysqli_real_escape_string($link,$_POST['nom'])."',
                    '".mysqli_real_escape_string($link,$_POST['prenoms'])."',
                    '".mysqli_real_escape_string($link,$_POST['datenais'])."',
                    '".($_FILES['photo']['name'])."',
                    '".mysqli_real_escape_string($link,$_POST['specialisation'])."',
                    '".mysqli_real_escape_string($link,$_POST['email'])."',
                    '".mysqli_real_escape_string($link,$_POST['mdp'])."',
                    '".mysqli_real_escape_string($link,$_POST['resume'])."')";
        if($result) {
            $msg='Insertion reussie';
        }else{
            $msg=mysqli_error($link);
        } 
      }
    ?>
<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--navigateur internet Exploreur-->
    <meta name="Viewport" content="witdth=device-width, initial-scale=1">
    <meta neme="description" content="">
    <meta name="author" content="Debora Amangoua">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  
    

    <title>Accueil</title>

  </head>

  <body style="background-color: beige;"><br><br><br>

 

    <div class="container" style="opacity: 0.85; padding:10px; ">
      <div class="row-padding">

        <?php
        // Connexion à la base de données
        // une autre manière de se connecter à la base de données
          try
          {
            $bdd = new PDO('mysql:host=localhost;dbname=db_cvs;charset=utf8', 'root', '');
          }
          catch(Exception $e)
          {
                  die('Erreur : '.$e->getMessage());
          }

          // On récupère les 5 derniers articles
          $req = $bdd->query('SELECT nom,prenoms,datenais,photo,specialisation,email,mdp,resume FROM codeuses ORDER BY id,nom DESC LIMIT 0, 3');
          while ($donnees = $req->fetch())
          {?>


        
          <div class="well well-lg">
            <div class="row">
              <div class="col-sm-3">
              <img src="upload/<?php echo $donnees['photo'];?>" style="width:150px; border-radius:90px; height:150px; margin-left: 20px;" alt="Ma photo de profil"/><br>
              
                <!-- htmlspecialchars : permet de proteger les textes -->
              <h3 style="color: blue;">
              <?php echo htmlspecialchars($donnees['prenoms']); ?>
              <?php echo htmlspecialchars($donnees['nom']); ?>
            </h3>
            </div>
            <div class="col-sm-6" style="font-size:15px; text-align: center;padding: 10px;">  
              <h3><?php echo nl2br(htmlspecialchars($donnees['specialisation']));?></h3>
              <p><?php echo nl2br(htmlspecialchars($donnees['resume']));?></p>
            </div>

            
         <div class="col-sm-2">
              <br><br><br>
                
                  <span class="badge" style="height: 30px; background-color: #DB7093!important; padding: 10px;"><a href="cvliste.php?cvliste=<?php echo $donnees['id']; ?>">Consulter le cv</a></span>
                </div>
          </div>
        </div>
        
 <?php
        } // Fin de la boucle des articles
          $req->closeCursor();
        ?> 

      </div>
    </div>
    
    <script type="text/javascript" src="js/bootstrap.js"></script>
  </body>
</html>

   
    