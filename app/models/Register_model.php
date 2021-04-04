<?php 
	class Register_model{
		private $table='register';
		private $db;

		public function __construct(){
			$this->db = new Database;
		}

		public function register($data){
				$this->db->query('SELECT username FROM register WHERE username = :username');
				$this->db->bind('username',strtolower(stripslashes(htmlspecialchars($data["username"]))));
				$data['tes']=$this->db->resultSet();
				foreach ($data['tes'] as $tampilkan) {
					if ($tampilkan['username']) {
						return false;
					}
				}
				$query="INSERT INTO $this->table VALUES('',:username,:password)";
				$this->db->query($query);
				$this->db->bind('username',strtolower(stripslashes(htmlspecialchars($data["username"]))));
				$this->db->bind('password',password_hash(htmlspecialchars($data["password"]),PASSWORD_DEFAULT));
				$password1=$data["password"];
				$password2=htmlspecialchars($data["password2"]);
				if ($password1 !== $password2 ) {
					return false;
				}
				$this->db->execute();
				return $this->db->rowCount();
		}
	}
 ?>