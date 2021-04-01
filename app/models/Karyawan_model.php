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

 	public function tambahDataKaryawan($data){
 		$query="INSERT INTO karyawan VALUES ('',:nama,:nohp,:email,:skill,:gambar)";
 		$this->db->query($query);
 		$this->db->bind('nama',$data['nama']);
 		$this->db->bind('nohp',$data['nohp']);
 		$this->db->bind('email',$data['email']);
 		$this->db->bind('skill',$data['skill']);
 		$gambar=$this->upload();
 		if( !$gambar ) {
			return false;
		}
 		$this->db->bind('gambar',$gambar);
 		$this->db->execute();
 		return $this->db->rowCount();
 	}

 	public function upload(){
 		$namaFile = $_FILES['gambar']['name'];
 		$ukuranFile = $_FILES['gambar']['size'];
 		$error = $_FILES['gambar']['error'];
 		$tmpName = $_FILES['gambar']['tmp_name'];

 		if ($error === 4) {
 			echo "
 				<script>
 					alert('pilih gambar terlebih dahulu!');
 				</script>	
 			";
 			return false;
 		}

 		$ekstensi1=["jpg","jpeg","png"];
 		$ekstensi2=pathinfo(strtolower($namaFile),PATHINFO_EXTENSION);
 		if (!in_array($ekstensi2, $ekstensi1)) {
 			echo "
 				<script>
 					alert('yang anda upload bukan gambar');
 				</script>	
 			";
 			return false;
 		}

 		if ($ukuranFile>1000000) {
 			echo "
 				<script>
 					alert('ukuran gambar terlalu besar!');
 				</script>	
 			";
 			return false;
 		}

 		$namaFileBaru  = uniqid();
 		$namaFileBaru .= '.';
 		$namaFileBaru .= $ekstensi2;
 		move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
 		return $namaFileBaru;
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
 		$this->db->bind('nama',$data['nama']);
 		$this->db->bind('nohp',$data['nohp']);
 		$this->db->bind('email',$data['email']);
 		$this->db->bind('skill',$data['skill']);
 		$this->db->bind('id',$data['id']);
 		$gambarLama=$data['gambarLama'];
 		if ($_FILES['gambar']['error'] === 4) {
 			$gambar=$gambarLama;
 		}
 		else{
 			$gambar=$this->upload();
 		}
 		$this->db->bind('gambar',$gambar);
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