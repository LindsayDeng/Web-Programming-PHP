<?php
	class Customer{
		private $customerID;
		private $name;
		private $phone;
		private $email;
		private $about;
		
		function __construct($name, $phone, $email, $about){
			$this->setName($name);
			$this->setPhone($phone);
			$this->setEmail($email);
			$this->setAbout($about);
		}
		
		public function getCustomerID(){
			return $this->customerID;
		}
		public function setCustomerID($customerID){
			$this->customerID = $customerID;
		}
		
		
		public function getName(){
			return $this->name;
		}
		
		public function setName($name){
			$this->name = $name;
		}
		
		public function getPhone(){
			return $this->phone;
		}
		
		public function setPhone($phone){
			$this->phone = $phone;
		}
		
		public function getEmail(){
			return $this->email;
		}
		
		public function setEmail($email){
			$this->email = $email;
		}
		
		public function getAbout(){
			return $this->about;
		}
		
		public function setAbout($about){
			$this->about = $about;
		}
		
	}
?>