<?php session_start(); ?>
<?php include('entete.php'); ?>
<?php include('connexion.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<meta name="viewport" content="width=devise-width,initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Debora Amangoua">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body style="background-color: pink;"><br><br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3"><br><br>
				<form action="" method="POST" role="form">
					<legend>Se connecter</legend>
					<div class="form-group">
						<label for="">EMAIL*</label>
						<input type="text" class="form-control" name="email" id="" placeholder="Exemple@email.com" required>
					</div>
					<div class="form-group">
						<label for="">MOT DE PASSE*</label>
						<input type="password" class="form-control" name="mdp" id="" placeholder="Saisir le mot de passe" required>
					</div>
					<button name="btnValider" type="submit" class="btn btn-primary">Valider</button>
					
					
				</form>
				<?php
						if(isset($_POST['btnValider'])) {
							$sql="SELECT * FROM users WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."' AND mdp='".mysqli_real_escape_string($link,md5($_POST['mdp']))."' LIMIT 0,1";
							$req=mysqli_query($link,$sql);
							if (mysqli_num_rows($req)>0) {
								$data=mysqli_fetch_array($req);
								$_SESSION['variable']=$data['id'];
								header('location:accueil.php');
							}else{echo "identifiants incorrects";
						}
						}
					 ?>
			</div>
			
		</div>
		
	</div>

</body>
</html>