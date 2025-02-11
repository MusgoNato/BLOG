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
            die("Não foi possivel se conectar ao banco de dados!");
        }
    }

    /**
     * Summary of getConection
     * Single Ton
     */
    public static function getConection()
    {
        if(self::$instance === null)
        {
            self::$instance = new Banco();
        }

        return self::$instance->conn;
    }

    /**
     * Summary of __clone
     * Evita que seja clonada a classe
     * @return void
     */
    private function __clone(){}

    /**
     * Summary of __wakeup
     * Evita a desserialização do objeto
     * @return void
     */
    public function __wakeup(){}

}

?>