<?php	
 class Karyawan_model{
 	private $table='karyawan';
 	private $db;
 	
 	public function __construct(){
 		$this->db = new Database;
 	}

 	public function getjumlahDataPerHalaman(){
 		return $jumlahDataPerHalaman=3;
 	}

 	public function getjumlahHalaman(){
		$result=$this->db->query('SELECT * FROM ' . $this->table);
		$this->db->execute();
		$jumlahData=$this->db->rowCount();
 		return $jumlahHalaman=ceil($jumlahData/$this->getjumlahDataPerHalaman());
 	}

 	public function getAllKaryawan($halaman){
 		$this->getjumlahHalaman();
 		$halamanAktif=$halaman;
		$awalData=($this->getjumlahDataPerHalaman()*$halamanAktif)-$this->getjumlahDataPerHalaman();
		$this->db->query('SELECT * FROM ' . $this->table.' LIMIT '.$awalData.','.$this->getjumlahDataPerHalaman());
 		return $this->db->resultSet();
 	}

 	public function getKaryawanById($id){
 		$this->db->query('SELECT * FROM '.$this->table.' WHERE id=:id');
 		$this->db->bind('id',$id);
 		return $this->db->single();		
 	}

 	public function upload(){
 		$namaFile = $_FILES['gambar']['name'];
 		$ukuranFile = $_FILES['gambar']['size'];
 		$error = $_FILES['gambar']['error'];
 		$tmpName = $_FILES['gambar']['tmp_name'];

 		if ($error === 4) {
 			return false;
 		}

 		$ekstensi1=["jpg","jpeg","png"];
 		$ekstensi2=pathinfo(strtolower($namaFile),PATHINFO_EXTENSION);
 		if (!in_array($ekstensi2, $ekstensi1)) {
 			return false;
 		}

 		if ($ukuranFile>1000000) {
 			return false;
 		}

 		$namaFileBaru  = uniqid();
 		$namaFileBaru .= '.';
 		$namaFileBaru .= $ekstensi2;
 		move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
 		return $namaFileBaru;
 	}

 	public function tambahDataKaryawan($data){
 		$query="INSERT INTO karyawan VALUES ('',:nama,:nohp,:email,:skill,:gambar)";
 		$this->db->query($query);
 		$this->db->bind('nama',htmlspecialchars($data['nama']));
 		$this->db->bind('nohp',htmlspecialchars($data['nohp']));
 		$this->db->bind('email',htmlspecialchars($data['email']));
 		$this->db->bind('skill',htmlspecialchars($data['skill']));
 		$gambar=$this->upload();
 		if( !$gambar ) {
			return false;
		}
 		$this->db->bind('gambar',htmlspecialchars($gambar));
 		$this->db->execute();
 		return $this->db->rowCount();
 	}

 	public function hapusDataKaryawan($id,$gambar){
 		$query="DELETE FROM karyawan WHERE id=:id";
 		$this->db->query($query);
 		$this->db->bind('id',$id);
 		$this->db->execute();
 		$path="img/$gambar";
 		unlink($path);
 		return $this->db->rowCount();
 	}

 	public function ubahDataKaryawan($data){
 		$query="UPDATE karyawan SET nama = :nama,nohp = :nohp,email = :email,skill = :skill,gambar = :gambar WHERE id = :id";
 		$this->db->query($query);
 		$this->db->bind('nama',htmlspecialchars($data['nama']));
 		$this->db->bind('nohp',htmlspecialchars($data['nohp']));
 		$this->db->bind('email',htmlspecialchars($data['email']));
 		$this->db->bind('skill',htmlspecialchars($data['skill']));
 		$this->db->bind('id',htmlspecialchars($data['id']));
 		$gambarLama=$data['gambarLama'];
 		if ($_FILES['gambar']['error'] === 4) {
 			$gambar=$gambarLama;
 		}
 		else{
 			$path="img/$gambarLama";
 			unlink($path);
 			$gambar=$this->upload();
 		}
 		$this->db->bind('gambar',htmlspecialchars($gambar));
 		$this->db->execute();
 		return $this->db->rowCount();
 	}

 	public function getjumlahHalaman2(){
		$keyword = $_SESSION['isi'];
        $query = "SELECT * FROM karyawan WHERE nama LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        $this->db->execute();
        $jumlahData=$this->db->rowCount();
        return $jumlahHalaman=ceil($jumlahData/$this->getjumlahDataPerHalaman());
 	}

 	public function cariDataKaryawan($halaman,$isi)
    {	
        $_SESSION['halaman']=$halaman;
        $_SESSION['isi']=$isi;
    	$this->getjumlahHalaman2();
 		$halamanAktif=$_SESSION['halaman'];
		$awalData=($this->getjumlahDataPerHalaman()*$halamanAktif)-$this->getjumlahDataPerHalaman();
		$keyword = $_SESSION['isi'];
        $query = "SELECT * FROM karyawan WHERE nama LIKE :keyword LIMIT ".$awalData.','.$this->getjumlahDataPerHalaman();
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }
 }