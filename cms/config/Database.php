<?php
class Database
{

	private $host  = 'localhost';
	// private $user  = 'u159225152_root';
	private $user  = 'root';
	// private $password   = "J8vvPtp1";
	private $password   = "";
	// private $database  = "u159225152_cms";
	private $database  = "cms";

	public function getConnection()
	{
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if ($conn->connect_error) {
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
	}
}
