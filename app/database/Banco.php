<?php

namespace app\database;
use PDO;
class Banco
{
    private static $instance = null;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'blogbd';
    private $conn;

    private function __construct()
    {
        try
        {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass);
        }catch(\PDOException $e) 
        {
            echo $e->getMessage();
        }
    }

    public static function getConection()
    {
        if(self::$instance === null)
        {
            self::$instance = new Banco();
        }

        return self::$instance->conn;
    }

    private function __clone(){}
    public function __wakeup(){}

}

?>