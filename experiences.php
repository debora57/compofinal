
<?php 
// Lancer la session
    session_start();



 ?> 
 <?php include('connexion.php');
$msg="";
      include('entete.php');
    if (isset($_GET['id'])){
    $update="SELECT * FROM experiences WHERE id=" .$_GET['id'];
    $res=mysqli_query($link,$update);
    $dataU=mysqli_fetch_array($res);
}
if (isset($_GET['sup'])){
    $delete="DELETE * FROM experiences WHERE id=" .$_GET['sup'];
    $res=mysqli_query($link,$delete);
}
    
 ?>

<?php

    $msg="";
    if (isset($_POST['btnValider'])){
        
            $sql= "INSERT INTO experiences (titre, description, debut,fin,id_codeuses,entreprise)
                    VALUES ('".mysqli_real_escape_string($link,$_POST['titre'])."',
                            '".mysqli_real_escape_string($link,$_POST['description'])."',
                            '".mysqli_real_escape_string($link,$_POST['debut'])."',
                            '".mysqli_real_escape_string($link,$_POST['fin'])."',
                            '".mysqli_real_escape_string($link,$_POST['codeuses'])."',
                            '".mysqli_real_escape_string($link,$_POST['entreprise'])."')"; 
                            //protection des variable
            $result=mysqli_query($link,$sql);
            if ($result) {
                $msg='Insertion reussie';
            }else{
                $msg=mysqli_error($link);
            }
        }
 ?>


<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Debora Amangoua">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    
        <title>Experiences professionnelles</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" >

        
    </head>
    <body ><br><br>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8" style="background-color: pink;">

                    <form action="" method="POST" role="form" enctype="multipart/form-data"><br><br><br>
                        <legend>Experiences Professionnelles</legend>
                        <span> <?php echo $msg; ?> </span>
                    
                        <div class="form-group">
                            <label for="">TITRE</label>
                            <input name="titre" type="text" class="form-control" id="" placeholder="Entrer le titre" value="<?php if (isset ($_GET['id'])) echo $dataU ['titre']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="">DESCRIPTION</label>
                            <textarea name="description" type="text" class="form-control" id="" placeholder="Entrer la description"><?php if (isset ($_GET['id'])) echo $dataU ['description']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for=""> DATE DEBUT</label>
                            <input name="debut" type="text" class="form-control" id="" placeholder="jj/mm/aaaa" value="<?php if (isset ($_GET['id'])) echo $dataU ['debut']; ?>">
                        </div>
                        <div class="form-group">
                            <label for=""> DATE FIN</label>
                            <input name="fin" type="text" class="form-control" id="" placeholder="jj/mm/aaaa" value="<?php if (isset ($_GET['id'])) echo $dataU ['fin']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">CODEUSES</label>
                            <select name="codeuses" class="form-control" placeholder="" value="<?php if (isset ($_GET['id'])) echo $dataU ['codeuses']; ?>">
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
                    </select>
                        </div>
                        <div class="form-group">
                            <label for="">ENTREPRISE</label>
                            <input name="entreprise" class="form-control" placeholder="Entrer le mail de l'entreprise" value="<?php if (isset ($_GET['id'])) echo $dataU ['entreprise']; ?>">
                                
                            
                        </div>
                        
                        <button name="btnValider" type="submit" class="btn btn-primary btn-lg btn-block">Ajouter</button>
                    </form>
                    </div>

                <div class="col-md-2"></div>

        </div>


            <div class="row" style="margin: 30px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Date Debut</th>
                            <th>Date Fin</th>
                            <th>Codeuses</th>
                            <th>Entreprise</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <?php 
                            $n=1;
                            $list=" SELECT 
                                        titre,
                                        experiences.description,
                                        debut,
                                        fin,
                                        nom,
                                        entreprise
                                    FROM codeuses
                                    INNER JOIN experiences
                                    ON codeuses.id = experiences.id_codeuses";
                            $res= mysqli_query($link,$list);
                            while ($data = mysqli_fetch_array($res)){
                                
                         ?>

                        <tr>
                            <td><?php echo $n;?></td>
                            <td><?php echo $data['titre'];?></td>
                            <td><?php echo $data['description'];?></td>
                            <td><?php echo $data['debut'];?></td>
                            <td><?php echo $data['fin'];?></td>
                            <td><?php echo $data['nom'];?></td>
                            <td><?php echo $data['entreprise'];?></td>
                                
                            <td>
                                <a href="?id=<?php echo $data['id']; ?>">Modifier</a>
                                <a href="?sup=<?php echo $data['id']; ?>">Supprimer</a>
                            </td>
                        </tr>
                        <?php
                            $n++;
                            }
                        ?>
                </table>
        
            </div>
            
    </body>
    </html>