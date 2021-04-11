<?php 
	session_start();
	require '../app/config/config.php';
	if (isset($_SESSION["login"])) {
		header('Location: '.BASEURL.'/home');
		exit;
	}
	require '../app/core/Database.php';
	if (isset($_POST["login"])) {
		$db = new Database;
		$db->query('SELECT * FROM register WHERE username = :username');
		$db->bind('username',strtolower(stripslashes(htmlspecialchars($_POST["username"]))));
		$db->execute();
		if ($db->rowCount() === 1) {
			$isi['tes']=$db->resultSet();
			foreach ($isi['tes'] as $tampilkan) {
				if (password_verify($_POST["password"], $tampilkan["password"])) {
					$_SESSION["login"]=true;
					header('Location: '.BASEURL.'/home');
					exit;
				}
			}
		}
		$error = true;
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center">Login</h1>
		<?php if (isset($error)) : ?>
			<div class="alert alert-danger" role="alert">
			  Username Atau Password Salah
			</div>
		<?php endif; ?>
		<form action="" method="post">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" class="form-control" required autocomplete="off" autofocus>
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control" required>
			</div>	

			<button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
		</form>
	</div>
	<script src="<?= BASEURL; ?>/js/jquery-3.3.1.min.js"></script>
	<script src="<?= BASEURL; ?>/js/popper.min.js"></script>
	<script src="<?= BASEURL; ?>/js/bootstrap.min.js"></script>
	<script src="<?= BASEURL; ?>/js/script.js"></script>
</body>
</html>