<?php
class Database{
  
    private $host = "mysql669.umbler.com:41890";
    private $db_name = "kabum";
    private $username = "user123";
    private $password = "teste123";
    public $conn;
  
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
