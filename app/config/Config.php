<?php

namespace config;

use PDO;
use PDOException;

class Config{   
    
    private static $instance;
    private $db;

    private $host = "127.0.0.1";
    private $port = "3306";
    private $dbname = "proyectoBDD";
    private $user = "root";
    private $pass = "";

    private function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset=utf8mb4";

            $this->db = new PDO($dsn, $this->user, $this->pass);

            // Opciones recomendadas
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Error al conectar con MySQL: " . $e->getMessage());
        }
    }

    public static function getInstance(): Config
    {
        if (!isset(self::$instance)) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    // Métodos mágicos get y set para acceder a propiedades privadas
    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}
?>