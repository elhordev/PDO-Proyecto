<?php

namespace services;

use models\Producto;
use PDO;
use Ramsey\Uuid\Uuid;
use PDOException;

require_once __DIR__ . '/../models/Producto.php';

class ProductosService
{


    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByMarca($marca)
    {

        $results = [];

        try {
            $stmt = $this->pdo->prepare('SELECT * FROM productos WHERE marca = :marca');

            $stmt->execute(array('marca' => $marca));


            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $res = Producto::__constructAllAtt(
                    $row['id'],
                    $row['descripcion'],
                    $row['imagen'],
                    $row['marca'],
                    $row['modelo'],
                    $row['precio'],
                    $row['stock'],
                    $row['updated_at'],
                    $row['categoria_id'],
                    $row['is_deleted'],
                    $row['created_at'],
                    $row['uuid']
                );
                $results[] = $res;
            }
        } catch (PDOException $err) {
            echo "Error: " . $err->getMessage();
            echo "Patata";
        }
        return $results;
    }

    public function findByModelo($modelo)
    {

        $results = [];

        try {
            $stmt = $this->pdo->prepare('SELECT * FROM productos WHERE modelo = :modelo');

            $res = $stmt->execute(array('modelo' => $modelo));

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $res = Producto::__constructAllAtt(
                    $row['id'],
                    $row['descripcion'],
                    $row['imagen'],
                    $row['marca'],
                    $row['modelo'],
                    $row['precio'],
                    $row['stock'],
                    $row['updated_at'],
                    $row['categoria_id'],
                    $row['is_deleted'],
                    $row['created_at'],
                    $row['uuid']
                );
                $results[] = $res;
            }
        } catch (PDOException $err) {
            echo "Error: " . $err;
        }
        return $results;
    }


    public function findByCategory($categoria) {}

    public function updateProduct($id) {}

    public function findAll()
    {
        $results = [];
        
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM productos');

            $res = $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $res = Producto::__constructAllAtt(
                    $row['id'],
                    $row['descripcion'],
                    $row['imagen'],
                    $row['marca'],
                    $row['modelo'],
                    $row['precio'],
                    $row['stock'],
                    $row['updated_at'],
                    $row['categoria_id'],
                    $row['is_deleted'],
                    $row['created_at'],
                    $row['uuid']
                );
                $results[] = $res;
            }
            
        } catch (PDOException $err) {
            echo "Error: " . $err;
        }
        return $results;
    }


    public function findById($id)
    {


        $results = [];

        try {
            $stmt = $this->pdo->prepare('SELECT * FROM productos WHERE id = :id');

            $res = $stmt->execute(array('id' => $id));

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $res = Producto::__constructAllAtt(
                    $row['id'],
                    $row['descripcion'],
                    $row['imagen'],
                    $row['marca'],
                    $row['modelo'],
                    $row['precio'],
                    $row['stock'],
                    $row['updated_at'],
                    $row['categoria_id'],
                    $row['is_deleted'],
                    $row['created_at'],
                    $row['uuid']
                );
                $results[] = $res;
            }
        } catch (PDOException $err) {
            echo "Error: " . $err;
        }
        return $results;
    }




    public function create(Producto $producto)
    {


        try {
            $stmt = $this->pdo->prepare('INSERT INTO productos (uuid, precio, stock, descripcion, imagen, marca, modelo, is_deleted, categoria_id, created_at, updated_at) VALUES(:uuid,:precio,:stock,:descripcion,:imagen,:marca,:modelo,:is_deleted,:categoria_id,:created_at,:updated_at)');

            $datos = array(
                ':uuid' => $producto->uuid,
                ':precio' => $producto->precio,
                ':stock' => $producto->stock,
                ':descripcion' => $producto->descripcion,
                ':imagen' => $producto->imagen,
                ':marca' => $producto->marca,
                ':modelo' => $producto->modelo,
                ':is_deleted' => $producto->isDeleted,
                ':categoria_id' => $producto->categoriaId,
                ':created_at' => $producto->createdAt,
                ':updated_at' => $producto->updatedAt
            );

            $stmt->execute($datos);
        } catch (PDOException $err) {
            echo "Error: " . $err;
        }
    }


    public function deleteByID($idProducto)
    {


        try {
            $stmt = $this->pdo->prepare('DELETE FROM productos WHERE id = :id');
            $stmt->execute(array(':id' => $idProducto));
            echo "Eliminado con éxito.";
        } catch (PDOException $err) {
            echo "Error: " . $err;
        }
    }
}
