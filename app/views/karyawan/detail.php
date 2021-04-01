<div class="container mt-5">
	<div class="card" style="width: 18rem;">
	  	<div class="card-body">
	  		<img src="../../../public/img/<?= $data['karyawan']['gambar']; ?>" width="50">
		    <h5 class="card-title"><?= $data['karyawan']['nama']; ?></h5>
		    <h6 class="card-subtitle mb-2 text-muted"><?= $data['karyawan']['nohp']; ?></h6>
		    <p class="card-text"><?= $data['karyawan']['email']; ?></p>
		    <p class="card-text"><?= $data['karyawan']['skill']; ?></p>
		    <a href="<?= BASEURL; ?>/karyawan" class="card-link">Kembali</a>
  		</div>
	</div>
</div>