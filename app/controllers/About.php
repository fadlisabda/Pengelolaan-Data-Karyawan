<?php 

class About extends Controller{
	public function index($nama='fadli',$pekerjaan='mahasiswa',$umur=20){
		$data['nama']=$nama;
		$data['pekerjaan']=$pekerjaan;
		$data['umur']=$umur;
		$data['judul']='about';
		$this->view('templates/header',$data);
		$this->view('about/index',$data); 
		$this->view('templates/footer');
	}
}