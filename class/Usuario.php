<?php

class Usuario {

	private $user_id;
	private $user_email;
	private $user_password;
	private $user_firstname;
	private $user_lastname;
	private $user_role;
	private $user_image;

	public function getUserId(){
		return $this->user_id;
	}

	public function setUserId($user_id){
		$this->user_id = $user_id;
	}

	public function getUserEmail(){
		return $this->user_email;
	}

	public function setUserEmail($user_email){
		$this->user_email = $user_email;
	}

	public function getUserPassword(){
		return $this->user_password;
	}

	public function setUserPassword($user_password){
		$this->user_password = $user_password;
	}

	public function getUserFirstname(){
		return $this->user_firstname;
	}

	public function setUserFirstname($user_firstname){
		$this->user_firstname = $user_firstname;
	}

	public function getUserLastname(){
		return $this->user_lastname;
	}

	public function setUserLastname($user_lastname){
		$this->user_lastname = $user_lastname;
	}

	public function getUserRole(){
		return $this->user_role;
	}

	public function setUserRole($user_role){
		$this->user_role = $user_role;
	}

	public function getUserImage(){
		return $this->user_image;
	}

	public function setUserImage($user_image){
		$this->user_image = $user_image;
	}

	public function loadById($id){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM users WHERE user_id = :user_id", array(":user_id"=>$id));

		if(isset($results[0])){

			$this->setData($results[0]);
		}
	}

	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM users ORDER BY user_firstname;");

	}

	public static function search($email){

		$sql = new Sql();

		return $sql->select("SELECT * FROM users WHERE user_email LIKE :search ORDER BY user_firstname", array(":search"=>"%" . $email ."%"));
	}

	public function login($email, $senha){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM users WHERE user_email = :user_email AND user_password = :password", array(":user_email"=>$email,
			":password"=>$senha));

		if(isset($results[0])){

			$this->setData($results[0]);

		} else {
			throw new Exception("Login e/ou senha inválidos");
		}

	}

	public function __construct($email = "", $senha = "", $firstname = "", $lastname = "", $role = "", $image = ""){
		$this->setUserEmail($email);
		$this->setUserImage($image);
		$this->setUserRole($role);
		$this->setUserFirstname($firstname);
		$this->setUserLastname($lastname);
		$this->setUserPassword($senha);
	}

	public function setData($data){
		$this->setUserId($data['user_id']);
		$this->setUserEmail($data['user_email']);
		$this->setUserImage($data['user_image']);
		$this->setUserRole($data['user_role']);
		$this->setUserFirstname($data['user_firstname']);
		$this->setUserLastname($data['user_lastname']);
		$this->setUserPassword($data['user_password']);
	}

	public function insert(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_users_insert(:user_email, :user_password, :user_firstname, :user_lastname, :user_role, :user_image)", array(
			":user_email"=>$this->getUserEmail(),
			":user_password"=>$this->getUserPassword(),
			":user_firstname"=>$this->getUserFirstname(),
			":user_lastname"=>$this->getUserLastname(),
			":user_role"=>$this->getUserRole(),
			":user_image"=>$this->getUserImage()
			));

		if(isset($results)){
			$this->setData($results[0]);
		}

	}

	public function __toString(){
		return json_encode(array(
			"user_id"=>$this->getUserId(),
			"user_image"=>$this->getUserImage(),
			"user_role"=>$this->getUserRole(),
			"user_firstname"=>$this->getUserFirstname(),
			"user_lastname"=>$this->getUserLastname(),
			"user_password"=>$this->getUserPassword(),
			"user_email"=>$this->getUserEmail(),
		));
	}	
}