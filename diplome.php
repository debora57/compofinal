<?php 
// Lancer la session
    session_start();

 ?> 

<?php include('connexion.php');
$msg="";
      include('entete.php');
    if (isset($_GET['id'])){
    $update="SELECT * FROM diplomes WHERE id=" .$_GET['id'];
    $res=mysqli_query($link,$update);
    $dataU=mysqli_fetch_array($res);
}
if (isset($_GET['sup'])){
    $delete="DELETE FROM diplomes WHERE id=" .$_GET['sup'];
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
    
        <title>Diplomes</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" >

    </head>
    <body><br><br>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8" style="background-color: pink;">

                    <form action="" method="POST" role="form" enctype="multipart/form-data"><br><br><br><br>
                        <legend>Ajouter Vos Diplomes</legend>
                        <span> <?php echo $msg; ?> </span>
                    
                        <div class="form-group">
                            <label for="">ETABLISSEMENT</label>
                            <input name="etablissement" type="text" class="form-control" id="" placeholder="Entrer l'etablissement" value="<?php if (isset ($_GET['id'])) echo $dataU ['etablissement']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">DIPLOME</label>
                            <input name="diplome" type="text" class="form-control" id="" placeholder="Entrer votre diplome" value="<?php if (isset ($_GET['id'])) echo $dataU ['diplome']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="">DATE D'OBTENTION</label>
                            <input name="dat" type="text" class="form-control" id="" placeholder="jj/mm/aaaa" value="<?php if (isset ($_GET['id'])) echo $dataU ['date']; ?>">
                        </div>
                    
                        <div class="form-group">
                            <label for="">CODEUSES</label>
                            <select name="codeuses" type="text" class="form-control" id="" placeholder=" " value="<?php if (isset ($_GET['id'])) echo $dataU ['codeuses']; ?>">
                            <?php
                    
                    $sqlcodeuse="SELECT * FROM codeuses";
                    
                    $repcodeuse=mysqli_query($link,$sqlcodeuse);
                    
                    while ($datacode=mysqli_fetch_array($repcodeuse)) {
                        ?>
                        <option value="<?php echo $datacode['id'];?>">
                        <?php echo $datacode['id'].'-'.$datacode['nom'];?>
                            
                        </option>

                        <?php
                    }
                    ?>
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
    <tr>
        <td>N°</td>
        <td>Etablissement</td>
        <td>Diplome</td>
        <td>Date d'obtention</td>
        <td>id_Codeuses</td>
        <td>Action</td>
    </tr>

     <?php 
                            $n=1;
                            $list=" SELECT 
                                        etablissement,
                                        diplomes.diplome,
                                        dat,
                                        nom
                                    FROM codeuses
                                    INNER JOIN diplomes
                                    ON codeuses.id = diplomes.id_codeuses";
                            $res= mysqli_query($link,$list);
                            while ($data = mysqli_fetch_array($res)){
                                
                         ?>

        <tr>
            <td><?php echo $n; ?></td> 
            <td><?php echo $data['etablissement'] ?></td> 
            <td><?php echo $data['diplome'] ?></td> 
            <td><?php echo $data['dat'] ?></td> 
            <td><?php echo $data['nom'] ?></td> 
            <td>
                                <a href="?id=<?php echo $data['id']; ?>">Modifier</a>
                                <a href="?sup=<?php echo $data['id']; ?>">Supprimer</a>
                            </td>
    </tr>
<?php
    $n++;
    }
?>



    <?php
    if(isset($_POST["btnValider"])) {
        
        if (isset($_GET['id'])) {
            $sql="UPDATE diplomes SET
            etablissement='".$_POST["etablissement"]."',
            diplome='".$_POST["diplome"]."',
            dat='".$_POST["dat"]."',
            codeuses='".$_POST["codeuses"]."' WHERE id=".$_GET['id'];
            //die($sql);

        }else{
            $sql="INSERT INTO diplomes (etablissement,diplome,dat,id_codeuses) 
        VALUES ('".mysqli_real_escape_string($link,$_POST['etablissement'])."',
                    '".mysqli_real_escape_string($link,$_POST['diplome'])."',
                    '".mysqli_real_escape_string($link,$_POST['dat'])."',
                    '".mysqli_real_escape_string($link,$_POST['codeuses'])."')";//die($sql);
        }
        $result=mysqli_query($link,$sql);
        if ($result) {
            echo "insertion reussie";
        }else{
            echo mysqli_error($link);
            die();
        }
    }
    ?>
            
</table>
        </div>
    </body>
    </html>