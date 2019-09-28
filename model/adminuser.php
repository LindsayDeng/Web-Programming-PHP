<?php
	class Adminuser{
		private $AdminID;
		private $Lastlogin;
		private $Password;
		private $Username;
		
		function __construct($AdminID, $Lastlogin, $Password, $Username){
			$this->setAdminID($AdminID);
			$this->setLastlogin($Lastlogin);
			$this->setPassword($Password);
			$this->setUsername($Username);
		}
		
		public function getAdminID(){
			return $this->AdminID;
		}
		
		public function setAdminID($AdminID){
			$this->AdminID = $AdminID;
		}
		
		public function setLastlogin($Lastlogin){
			$this->Lastlogin = $Lastlogin;
		}
		
		public function getLastlogin(){
			return $this->Lastlogin;
		}
		
		public function setPassword($Password){
			$this->Password = $Password;
		}
		
		public function getPassword(){
			return $this->Password;
		}
		
		public function setUsername($Username){
			$this->Username = $Username;
		}
		
		public function getUsername(){
			return $this->Username;
		}
		
	}
?>