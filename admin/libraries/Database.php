<?php 
namespace admin\libraries;

class Database 
{
    const DB_HOST      = "localhost";
    const DB_USER      = "root";
    const DB_PASSWORD  = "";
    const DB_NAME      = "mock";

    public $connection;

    public function __construct()
    {
        $this->open_db_connection();
    }

    public function open_db_connection()
    {
        $this->connection = new \mysqli(self::DB_HOST, self::DB_USER, self::DB_PASSWORD, self::DB_NAME);

        if($this->connection->connect_errno){
            die("database failed connect".$this->connection->connect_error);
        }
      
    }
    
}
