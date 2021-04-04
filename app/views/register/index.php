<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Register</title>
	<link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.min.css">
</head>
<body>
    <h1>Halaman Registrasi</h1>
    <div class="row">
      <div class="col-lg-6">
        <?php Flasher::flash(); ?>
      </div>
    </div>	
    <form action="<?= BASEURL; ?>/register/tambah" method="post">
	    <ul>
			<li>
				<label for="username">username :</label>
				<input type="text" name="username" id="username">
			</li>
			<li>
				<label for="password">password :</label>
				<input type="password" name="password" id="password">
			</li>
			<li>
				<label for="password2">konfirmasi password :</label>
				<input type="password" name="password2" id="password2">
			</li>
			<li>
				<button type="submit">Register!</button>
			</li>
		</ul>	
    </form>
    <script src="<?= BASEURL; ?>/js/jquery-3.3.1.min.js"></script>
	<script src="<?= BASEURL; ?>/js/popper.min.js"></script>
	<script src="<?= BASEURL; ?>/js/bootstrap.min.js"></script>
	<script src="<?= BASEURL; ?>/js/script.js"></script>
</body>
</html>