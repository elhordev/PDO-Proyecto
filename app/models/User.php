<?php
namespace models;

class User{

    private $id;
    private $username;
    private $password;
    private $nombre;
    private $apellidos;
    private $email;
    private $createdAt;
    private $updatedAt;
    private $isDeleted;
    private $roles;


    public function __construct($username, $password, $nombre, $apellidos, $email,$roles)
    {
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->createdAt = date("Y-m-d H:i:s",time());#date("Y-m-d H:i:s") // 2001-03-10 17:16:18 (the MySQL DATETIME format)(https://www.php.net/manual/es/function.date.php)
        $this->isDeleted = false;
        $this->roles = $roles;
    }

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