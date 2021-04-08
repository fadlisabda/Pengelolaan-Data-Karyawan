<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h3 class="text-center">Register</h3>
		<?php Flasher::flash(); ?>
	    <form action="<?= BASEURL; ?>/register/tambah" method="post">
			<div cass="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" class="form-control" required autocomplete="off" autofocus placeholder="username otomatis huruf kecil">
			</div>	
			<div cass="form-group">	
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control" required>
			</div>
			<div cass="form-group">	
				<label for="password2">Konfirmasi Password</label>
				<input type="password" name="password2" id="password2" class="form-control" required>
			</div>	
			<button type="submit" class="btn btn-primary mt-2 btn-block">Register</button>	
		</form> 
	</div>	
    <script src="<?= BASEURL; ?>/js/jquery-3.3.1.min.js"></script>
	<script src="<?= BASEURL; ?>/js/popper.min.js"></script>
	<script src="<?= BASEURL; ?>/js/bootstrap.min.js"></script>
	<script src="<?= BASEURL; ?>/js/script.js"></script>
</body>
</html>