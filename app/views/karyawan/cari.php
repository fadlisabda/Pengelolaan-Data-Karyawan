<link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.min.css">
<div class="container mt-3">
<div class="row">
<div class="col-lg-6">
<?php 
  $object1 = new Karyawan_model; 
  $jumlahHalaman=$object1->getjumlahHalaman2();
  $object2 = new App; 
  $url=$object2->parseURL();
  $halamanAktif=$url[2];
  if (isset($url[3])) {
    $keyword=$url[3]; 
  }
?>
<?php if ($halamanAktif>1) : ?>
  <?php if (isset($keyword)): ?>
    <a href="<?= BASEURL; ?>/karyawan/cari/<?= $halamanAktif-1; ?>/<?= $keyword; ?>" class="tombol-pagination">&laquo;</a>
  <?php endif ?>
<?php endif; ?>

<?php for ($i=1; $i <= $jumlahHalaman; $i++) : ?>
  <?php if ($i==$halamanAktif) : ?>
    <?php if (isset($keyword)): ?>
      <a href="<?= BASEURL; ?>/karyawan/cari/<?= $i; ?>/<?= $keyword; ?>" class="font-weight-bold text-danger" class="tombol-pagination"><?= $i; ?></a> 
    <?php endif ?>  
  <?php else : ?>
    <?php if (isset($keyword)): ?>
        <a href="<?= BASEURL; ?>/karyawan/cari/<?= $i; ?>/<?= $keyword; ?>" class="tombol-pagination"><?= $i; ?></a>
    <?php endif ?>
  <?php endif; ?>  
<?php endfor; ?>   

<?php if ($halamanAktif<$jumlahHalaman): ?>
  <?php if (isset($keyword)): ?>
    <a href="<?= BASEURL; ?>/karyawan/cari/<?= $halamanAktif+1; ?>/<?= $keyword; ?>" class="tombol-pagination">&raquo;</a>
  <?php endif ?>
<?php endif; ?>

<ul class="list-group">
  <?php foreach( $data['karyawan'] as $kry ) : ?>
      <li class="list-group-item">
          <?= $kry['nama']; ?>
      </li>
  <?php endforeach; ?>
</ul>
<a href="<?= BASEURL; ?>/karyawan/1" class="card-link">Kembali</a>
</div>
</div>
</div>
<script src="<?= BASEURL; ?>/js/jquery-3.3.1.min.js"></script>
<script src="<?= BASEURL; ?>/js/script.js"></script>