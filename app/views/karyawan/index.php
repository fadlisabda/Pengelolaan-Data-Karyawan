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
        <form action="<?= BASEURL; ?>/karyawan/cari" method="post">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="cari karyawan.." name="keyword" id="keyword" autocomplete="off">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit" id="tombolCari">Cari</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  
    <div class="row">
        <div class="col-lg-6">
          <h3>Daftar Karyawan</h3>
          <ul class="list-group">
            <?php foreach( $data['karyawan'] as $kry ) : ?>
              <li class="list-group-item">
                  <?= $kry['nama']; ?>
                  <a href="<?= BASEURL; ?>/karyawan/hapus/<?= $kry['id']; ?>" class="badge badge-danger float-right" onclick="return confirm('yakin?');" style="margin-left: 3px;">hapus</a>

                  <a href="<?= BASEURL; ?>/karyawan/ubah/<?= $kry['id']; ?>" class="badge badge-success float-right tampilModalUbah" data-toggle="modal" data-target="#formModal" data-id="<?= $kry['id']; ?>" style="margin-left: 3px;">ubah</a>

                  <a href="<?= BASEURL; ?>/karyawan/detail/<?= $kry['id']; ?>" class="badge badge-primary float-right">detail</a>
              </li>
            <?php endforeach; ?>
          </ul>      
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
            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="nohp">No Hp</label>
            <input type="number" class="form-control" id="nohp" name="nohp" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="skill">Skill</label>
            <select class="custom-select" id="skill" name="skill" multiple>
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