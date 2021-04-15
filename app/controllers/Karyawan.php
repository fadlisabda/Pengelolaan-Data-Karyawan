<?php 

class Karyawan extends Controller{
	public function index($halaman){
		$data['judul']='Daftar Karyawan';
		$data['karyawan']=$this->model('Karyawan_model')->getAllKaryawan($halaman);
		$this->view('templates/header',$data);
		$this->view('karyawan/index',$data);
		$this->view('templates/footer');	
	}

	public function detail($id){
		$data['judul']='Detail Karyawan';
		$data['karyawan']=$this->model('Karyawan_model')->getKaryawanById($id);
		$this->view('templates/header',$data);
		$this->view('karyawan/detail',$data);
		$this->view('templates/footer');	
	}

	public function tambah(){
		if ($this->model('Karyawan_model')->tambahDataKaryawan($_POST) > 0) {
			Flasher::setFlash('berhasil','ditambahkan','success');
			header('Location: '.BASEURL.'/karyawan');
			exit;
		} else{
			Flasher::setFlash('gagal','ditambahkan','danger');
			header('Location: '.BASEURL.'/karyawan');
			exit;
		}
	}

	public function hapus($id,$gambar){
		if ($this->model('Karyawan_model')->hapusDataKaryawan($id,$gambar) > 0) {
			Flasher::setFlash('berhasil','dihapus','success');
			header('Location: '.BASEURL.'/karyawan');
			exit;
		} else{
			Flasher::setFlash('gagal','dihapus','danger');
			header('Location: '.BASEURL.'/karyawan');
			exit;
		}
	}

	public function getubah(){
		echo json_encode($this->model('Karyawan_model')->getKaryawanById($_POST['id']));
	}

	public function ubah(){
		if ($this->model('Karyawan_model')->ubahDataKaryawan($_POST) > 0) {
			Flasher::setFlash('berhasil','diubah','success');
			header('Location: '.BASEURL.'/karyawan');
			exit;
		} else{
			Flasher::setFlash('gagal','diubah','danger');
			header('Location: '.BASEURL.'/karyawan');
			exit;
		}
	}

	public function cari(){
		$data['judul']='Daftar Karyawan';
		$data['karyawan']=$this->model('Karyawan_model')->cariDataKaryawan();
		$this->view('templates/header',$data);
		$this->view('karyawan/index',$data);
		$this->view('templates/footer');	
	}

}	