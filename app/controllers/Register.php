<?php 
	class Register extends Controller{
		public function index(){
			$this->view('register/index');
		}

		public function tambah(){
			if ($this->model('Register_model')->register($_POST) > 0) {
				Flasher::setFlash('berhasil','register','success');
				header('Location: '.BASEURL.'/register');
				exit;
				}
			else{
				Flasher::setFlash('gagal','register','danger');
				header('Location: '.BASEURL.'/register');
				exit;
			}
		}
	}
 ?>