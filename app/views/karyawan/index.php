<div class="container mt-3">

    <div class="row">
      <div class="col-lg-6">
        <?php Flasher::flash(); ?>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-lg-6">
        <button type="button" class="btn btn-primary tombolTambahData" data-toggle="modal" data-target="#formModal">
          Tambah Data Karyawan
        </button>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-lg-6">
        <form action="<?= BASEURL; ?>/karyawan/cari/1" method="post">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="cari karyawan.." name="keyword" id="keyword" autocomplete="off">
            </div>
        </form>
        <img src="../../public/img/loader.gif" class="loader" height="50" style="margin-left: 450px;margin-top: -60px;display: none;">
      </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
          <h3>Daftar Karyawan</h3>
          <div id="isiListData">
          <?php 
          $object1 = new Karyawan_model; 
          $jumlahHalaman=$object1->getjumlahHalaman();
          $object2 = new App; 
          $halamanAktif1=$object2->parseURL();
          $halamanAktif=$halamanAktif1[1];
          ?>
          <?php if ($halamanAktif>1) : ?>
            <a href="<?= BASEURL; ?>/karyawan/<?= $halamanAktif-1; ?>">&laquo;</a>
          <?php endif; ?>

          <?php for ($i=1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if ($i==$halamanAktif) : ?>
              <a href="<?= BASEURL; ?>/karyawan/<?= $i; ?>" class="font-weight-bold text-danger"><?= $i; ?></a> 
            <?php else : ?>
              <a href="<?= BASEURL; ?>/karyawan/<?= $i; ?>"><?= $i; ?></a>
            <?php endif; ?>  
          <?php endfor; ?>   

          <?php if ($halamanAktif<$jumlahHalaman): ?>
            <a href="<?= BASEURL; ?>/karyawan/<?= $halamanAktif+1; ?>">&raquo;</a>
          <?php endif; ?>

          <ul class="list-group">
            <?php foreach( $data['karyawan'] as $kry ) : ?>
                <li class="list-group-item">
                    <?= $kry['nama']; ?>
                    <a href="<?= BASEURL; ?>/karyawan/hapus/<?= $kry['id']; ?>/<?= $kry['gambar']; ?>" class="badge badge-danger float-right" onclick="return confirm('yakin?');" style="margin-left: 3px;">hapus</a>

                    <a href="<?= BASEURL; ?>/karyawan/ubah/<?= $kry['id']; ?>" class="badge badge-success float-right tampilModalUbah" data-toggle="modal" data-target="#formModal" data-id="<?= $kry['id']; ?>" style="margin-left: 3px;">ubah</a>

                    <a href="<?= BASEURL; ?>/karyawan/detail/<?= $kry['id']; ?>" class="badge badge-primary float-right">detail</a>
                </li>
            <?php endforeach; ?>
          </ul>  
          </div> 
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Tambah Data Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form action="<?= BASEURL; ?>/karyawan/tambah" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id">  
          <input type="hidden" name="gambarLama" id="gambarLama">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="nohp">No Hp</label>
            <input type="number" class="form-control" id="nohp" name="nohp" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="skill">Skill</label>
            <select class="custom-select" id="skill" name="skill" multiple required>
              <option value="HTML">HTML</option>
              <option value="CSS">CSS</option>
              <option value="PHP">PHP</option>
              <option value="Java Script">Java Script</option>
              <option value="C++">C++</option>
              <option value="Java">Java</option>
            </select>
          </div>

          <div class="form-group">
              <label for="gambar">Profile : </label>
              <input type="file" id="gambar" name="gambar">
              <small id="passwordHelpBlock" class="form-text text-muted helptext"></small>
          </div>

      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
      </div>
    </div>
  </div>
</div>