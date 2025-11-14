<?php

namespace models;

use Ramsey\Uuid\Uuid;

class Producto{

    private $id;
    private $descripcion;
    private $imagen;
    private $marca;
    private $modelo;
    private $precio;
    private $stock;
    private $createdAt;
    private $updatedAt;
    private $categoriaId;
    private $isDeleted;
    private $uuid;

    public function __construct($marca, $modelo, $precio, $descripcion, $imagen, $stock, $categoriaId)
    {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->stock = $stock;
        $this->categoriaId = $categoriaId;
        $this->createdAt = date("Y-m-d H:i:s",time());#date("Y-m-d H:i:s") // 2001-03-10 17:16:18 (the MySQL DATETIME format)(https://www.php.net/manual/es/function.date.php)
        $this->isDeleted = false;
        $this->uuid = $this->generateUUID();
    }

    public static function __constructAllAtt($id, $descripcion, $imagen, $marca, $modelo, $precio, $stock, $updatedAt, $categoriaId, $isDeleted, $createdAt, $uuid){
           
        $instance = new self($marca,$modelo,$precio,$descripcion, $imagen, $stock,$categoriaId);
        $instance->id = $id;
        $instance->updatedAt = $updatedAt;        
        $instance->isDeleted = $isDeleted;
        $instance->createdAt = $createdAt;
        $instance->uuid = $uuid;
        
        return $instance;
    
    }

    public function __get($modelo)
    {
        return $this->$modelo;
    }

    public function __set($modelo, $value)
    {
        $this->$modelo = $value;
    }

    private function generateUUID()
    {
        return Uuid::uuid4()->toString();
    }



}




?>