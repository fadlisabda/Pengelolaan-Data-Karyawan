<?php 
	session_start();
	require '../app/config/config.php';
	require '../app/core/Database.php';
	if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
		$id = $_COOKIE['id'];
		$key= $_COOKIE['key']; 
		$db = new Database;
		$db->query('SELECT username FROM register WHERE id = :id');
		$db->bind('id',strtolower(stripslashes(htmlspecialchars($id))));
		$db->execute();
		$isi['data1']=$db->resultSet();
		foreach ($isi['data1'] as $tampilkan) {
			if ($key === hash('sha256', $tampilkan['username'])) {
				$_SESSION['masuk']=true;
				$_SESSION["nama"]=$tampilkan["username"];
			}
		}
	}

	if (isset($_SESSION["masuk"])) {
		header('Location: '.BASEURL.'/home');
		exit;
	}

	if (isset($_POST["login"])) {
		$db = new Database;
		$db->query('SELECT * FROM register WHERE username = :username');
		$db->bind('username',strtolower(stripslashes(htmlspecialchars($_POST["username"]))));
		$db->execute();
		if ($db->rowCount() === 1) {
			$isi['data2']=$db->resultSet();
			foreach ($isi['data2'] as $tampilkan) {
				if (password_verify($_POST["password"], $tampilkan["password"])) {
					$_SESSION["masuk"]=true;
					$_SESSION["nama"]=$tampilkan["username"];
					if (isset($_POST['remember'])) {
						setcookie('id',$tampilkan['id'],time()+60);
						setcookie('key',hash('sha256', $tampilkan['username']),time()+60);
					}
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

			<div class="form-check">
				<input type="checkbox" name="remember" id="remember" class="form-check-input">
				<label for="remember" class="form-check-label">remember</label>
			</div>

			<button type="submit" name="login" class="btn btn-primary btn-block">Login</button>

			<p class="font-weight-bold text-center">Belum Daftar ? </p>
			<div class="text-center">
				<a href="<?= BASEURL; ?>/register">Daftar Disini</a>
			</div>	
		</form>
	</div>
	<script src="<?= BASEURL; ?>/js/jquery-3.3.1.min.js"></script>
	<script src="<?= BASEURL; ?>/js/popper.min.js"></script>
	<script src="<?= BASEURL; ?>/js/bootstrap.min.js"></script>
	<script src="<?= BASEURL; ?>/js/script.js"></script>
</body>
</html>