<?php

class Database {
	public $host = DB_HOST;
	public $username = DB_USER;
	public $password = DB_PASS;
	public $db_name = DB_NAME;

	public $link;
	public $errors;

	/*
	 * Class Construct
	 */
	public function __construct(){
		//Call Connect Function
		$this->connect();
	}

	/*
	 * Connector
	 */
	public function connect(){
		$this->link = new mysqli($this->host, $this->username, $this->password, $this->db_name);

		if(!$this->link){
			$this->errors = "Connection Failed: ".$this->link->connect_error;
			return false;
		}
	}

	/*
	 * Select
	 */
	public function select($query){
		$result = $this->link->query($query) or die($this->link->errors.__LINE__);
		if($result->num_rows > 0){
			return $result;
		} else {
			return false;
		}
	}

	/*
	 * Insert
	 */
	public function insert($query){
		$insert_row = $this->link->query($query) or die($this->link->errors.__LINE__);

		//Validate Insert
		if($insert_row) {
			header("Location: admin.php?msg=".urlencode('Запись добавлена'));
			exit();
		} else {
			die('Ошибка : ('. $this->link->errno .') '. $this->link->errors);
		}
	}

	/*
	 * Update
	 */
	public function update($query){
		$update_row = $this->link->query($query) or die($this->link->errors.__LINE__);

		//Validate Insert
		if($update_row) {
			header("Location: admin.php?msg=".urlencode('Запись обновлена'));
			exit();
		} else {
			die('Ошибка : ('. $this->link->errno .') '. $this->link->errors);
		}
	}

	/*
	 * Delete
	 */
	public function delete($query){
		$delete_row = $this->link->query($query) or die($this->link->errors.__LINE__);

		//Validate Insert
		if($delete_row) {
			header("Location: admin.php?msg=".urlencode('Запись удалена'));
			exit();
		} else {
			die('Ошибка : ('. $this->link->errno .') '. $this->link->errors);
		}
	}
}
