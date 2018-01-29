<?php include('connexion.php');
$msg="";
      include('entete.php');


if (isset($_GET['id'])){
    $update="SELECT * FROM codeuses WHERE id=".$_GET['id'];
    $res=mysqli_query($link,$update);
    $dataU=mysqli_fetch_array($res);
}
if (isset($_GET['sup'])){
    $delete="DELETE FROM codeuses WHERE id=" .$_GET['sup'];
    $res=mysqli_query($link,$delete);
}
    
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
    
        <title>Inscription</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" >

    </head>
    <body><br><br>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8" style="background-color: pink;">

                    <form action="" method="POST" role="form" enctype="multipart/form-data">
                        <legend>Inscription</legend>
                        <span> <?php echo $msg; ?> </span>
                    
                        <div class="form-group">
                            <label for="">NOM</label>
                            <input name="nom" type="text" class="form-control" id="" placeholder="Entrer le nom" value="<?php if (isset ($_GET['id'])) echo $dataU ['nom']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">PRENOMS</label>
                            <input name="prenoms" type="text" class="form-control" id="" placeholder="Entrer votre prenom" value="<?php if (isset ($_GET['id'])) echo $dataU ['prenoms']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">NAISSANCE</label>
                            <input name="datenais" type="text" class="form-control" id="" placeholder="jj/mm/aaaa" value="<?php if (isset ($_GET['id'])) echo $dataU ['datenais']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="">PHOTO</label>
                            <input name="photo" type="file" class="form-control" id="" value="<?php if (isset ($_GET['id'])) echo $dataU ['photo']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">SPECIALISATION</label>
                            <input name="specialisation" type="text" class="form-control" id="" placeholder="Entrer votre specialisation" value="<?php if (isset ($_GET['id'])) echo $dataU ['specialisation']; ?>">
                        </div>
                    <div class="form-group">
                        <label for="">EMAIL*</label>
                        <input type="text" class="form-control" name="email" id="" placeholder="Exemple@email.com" value="<?php if (isset ($_GET['id'])) echo $dataU ['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">MOT DE PASSE*</label>
                        <input type="password" class="form-control" name="mdp" id="" placeholder="Saisir le mot de passe" value="<?php if (isset ($_GET['id'])) echo $dataU ['mdp']; ?>" required>
                    </div>
                        <div class="form-group">
                            <label for="">RESUME</label>
                            <textarea name="resume" type="text" class="form-control" id="" placeholder="Entrer un resumé " ><?php if (isset ($_GET['id'])) echo $dataU ['resume']; ?></textarea>
                        </div>
                        </div>
                        <button name="btnValider" type="submit" class="btn btn-primary btn-lg btn-block">Valider</button>
                    </form>
                </div>

                <div class="col-md-2"></div>

            </div><br>


            <div class="row" style="margin: 30px;">
                <table class="table">
    <tr>
        <td>N°</td>
        <td>Nom</td>
        <td>Prenoms</td>
        <td>Date de naissance</td>
        <td>Photo de profil</td>
        <td>Specialisation</td>
        <td>email</td>
        <td>resume</td>
        <td>Action</td>
    </tr>

    <?php
        $n=1;
        $requet="SELECT * FROM codeuses";
        $result=mysqli_query($link,$requet);
        while ($data=mysqli_fetch_array($result)) {
    ?>

        <tr>
            <td><?php echo $n; ?></td> 
            <td><?php echo $data['nom'] ?></td> 
            <td><?php echo $data['prenoms'] ?></td> 
            <td><?php echo $data['datenais'] ?></td> 
            <td><img src="upload/<?php echo $data['photo'];?>" width="30px" height="30px" alt=""></td>
            <td><?php echo $data['specialisation'] ?></td> 
            <td><?php echo $data['email'] ?></td>
            <!-- <td><?php echo $data['mdp'] ?></td> -->
            <td><?php echo $data['resume'] ?></td> 
            <td>
                <a href="?id="<?php echo $data['id']; ?>">Modifier</a>
                
                <a href="?sup="<?php echo $data['id']; ?>">Supprimer</a>
            </td>
    </tr>
<?php
    $n++;
    }
?>

</table>

    <?php
    if(isset($_POST["btnValider"])) {
        if (move_uploaded_file($_FILES['photo']['tmp_name'], 'upload/'.$_FILES['photo']['name'])) {
        if (isset($_GET['id'])) {
            $sql="UPDATE codeuses SET
            nom='".$_POST["nom"]."',
            prenoms='".$_POST["prenoms"]."',
            datenais='".$_POST["datenais"]."',
            photo='".$_FILES["photo"]."',
            specialisation='".$_POST["specialisation"]."',
            email='".$_POST["email"]."',
            mdp='".$_POST["mdp"]."',

            resume='".$_POST["resume"]."' WHERE id=".$_GET['id'];
            //die($sql);

        }else{
            $sql="INSERT INTO codeuses (nom,prenoms,datenais,photo,specialisation,email,mdp,resume) 
        VALUES ('".mysqli_real_escape_string($link,$_POST['nom'])."',
                    '".mysqli_real_escape_string($link,$_POST['prenoms'])."',
                    '".mysqli_real_escape_string($link,$_POST['datenais'])."',
                    '".($_FILES['photo']['name'])."',
                    '".mysqli_real_escape_string($link,$_POST['specialisation'])."',
                    '".mysqli_real_escape_string($link,$_POST['email'])."',
                    '".mysqli_real_escape_string($link,$_POST['mdp'])."',
                    '".mysqli_real_escape_string($link,$_POST['resume'])."')";//die($sql);
        }
        $result=mysqli_query($link,$sql);
        if ($result) {
            echo "insertion reussie";
        }else{
            echo mysqli_error($link);
            die();
        }
    }
    }
    ?>

            </div>
            

        </div>
    </body>
    </html>