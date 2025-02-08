<?php

class Banco
{
    private $instance = null;
    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $conn;

    function __construct()
    {
        try
        {
            $this->conn = new PDO();
        }catch(PDOException $e) 
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

        return $this->conn;
    }

}

?>