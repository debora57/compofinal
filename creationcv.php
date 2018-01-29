<?php 
// Lancer la session
    session_start();

 ?> 

<?php include('connexion.php');
$msg="";
      include('entete.php');
    
 ?>


<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta neme="description" content="">
        <meta name="author" content="Debora Amangoua">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    
        <title>Creation de CV</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" >

    </head>
    <body ><br><br>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8" style="background-color: pink;">

                    <form action="" method="POST" role="form" enctype="multipart/form-data"><br><br><br><br>
                        <legend>CREER VOTRE CV</legend>
                        <span> <?php echo $msg; ?> </span>
                    
                        <div class="form-group">
                            <label for="">FACEBOOK</label>
                            <input name="facebook" type="text" class="form-control" id="" placeholder="lien profil facebook" required>
                        </div>
                        <div class="form-group">
                            <label for="">TWITTER</label>
                            <input name="twitter" type="text" class="form-control" id="" placeholder="lien profil twitter">
                        </div>
                        <div class="form-group">
                            <label for="">GITHUB</label>
                            <input name="github" type="text" class="form-control" id="" placeholder="lien profil github">
                        </div>

                            </select>
                        </div>
                        <button name="btnValider" type="submit" class="btn btn-primary btn-lg btn-block">Valider</button>
                    </form>
                </div>

                <div class="col-md-2"></div>

            </div><br>


            <div class="row" style="margin: 30px;">
                <table class="table">
    <!-- <tr>
        <td>N°</td>
        <td>Facebook</td>
        <td>Twitter</td>
        <td>Github</td>
        <td>Action</td>
    </tr>

    <?php
        $n=1;
        $requet="SELECT * FROM cv";
        $result=mysqli_query($link,$requet);
        while ($data=mysqli_fetch_array($result)) {
    ?>

        <tr>
            <td><?php echo $n; ?></td> 
            <td><?php echo $data['facebook'] ?></td> 
            <td><?php echo $data['twitter'] ?></td> 
            <td><?php echo $data['github'] ?></td> 
            <td>
                <a href="?id="<?php echo $data['id']; ?>">Ajouter</a>
                <a href="?id="<?php echo $data['id']; ?>">Modifier</a>
                
                <a href="?sup="<?php echo $data['id']; ?>">Supprimer</td>
                <a href="?sup="<?php echo $data['id']; ?>">Afficher un CV</td> 
    </tr>
<?php
    $n++;
    }
?>

</table> -->

    <?php
    if(isset($_POST["submit"])) {
            $sql="INSERT INTO cv (facebook,twitter,github) 
        VALUES ('".mysqli_real_escape_string($link,$_POST['facebook'])."',
                    '".mysqli_real_escape_string($link,$_POST['twitter'])."',
                    '".mysqli_real_escape_string($link,$_POST['github'])."')";//die($sql);

        $result=mysqli_query($link,$sql);
        if ($result) {
            echo "insertion reussie";
        }else{
            echo mysqli_error($link);
            die();
        }
    }
    
    ?>

            </div>
            

        </div>
    </body>
    </html>