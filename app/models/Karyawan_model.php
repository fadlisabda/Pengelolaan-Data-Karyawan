<?php 

 class Karyawan_model{
 	private $table='karyawan';
 	private $db;

 	public function __construct(){
 		$this->db = new Database;
 	}

 	public function getAllKaryawan(){
 		$this->db->query('SELECT * FROM ' . $this->table);
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

 	public function hapusDataKaryawan($id){
 		$query="DELETE FROM karyawan WHERE id=:id";
 		$this->db->query($query);
 		$this->db->bind('id',$id);
 		$this->db->execute();
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
 			$gambar=$this->upload();
 		}
 		$this->db->bind('gambar',htmlspecialchars($gambar));
 		$this->db->execute();
 		return $this->db->rowCount();
 	}

 	public function cariDataKaryawan(){
 		$keyword=$_POST['keyword'];
 		$query="SELECT * FROM karyawan WHERE nama LIKE :keyword";
 		$this->db->query($query);
 		$this->db->bind('keyword',"%$keyword%");
 		return $this->db->resultSet();
 	}

 }