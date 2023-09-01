<?php

class Database
{     
  private $localhost= 'localhost'; 
  private $username = 'root';
  private $password = '';
  private $database = 'school';
  protected $connection;


  public function __construct()
  {
    $this->connection = new mysqli($this->localhost,$this->username,$this->password,$this->database);
    if($this->connection->connect_error)
    {
      return $this->connection;
    }
    else
    {
      // echo "Successful";
    }
  }
  public function fetch_connection()
  {
    return $this->connection;
  }
}





?>