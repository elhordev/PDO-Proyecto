<?php

namespace services;


use Exception;
use models\User;
use PDO;

require_once __DIR__ . '/../models/User.php';

class UsersService{
    
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    public function authenticate($username, $password){

        try{
            $user = $this->findUserByName($username);

            $passBDD = $user->password;

            if(password_verify($password, $passBDD)){
                return $user;}
            

        }catch (PDOException $err) {
            echo "Error: " . $err;
            echo "Ha habido un error al verificar la contraseña.";
            return null;
        }
    }

    public function findUserByName($username){

        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE
                                    username = :username');
        
        $data = array('username' => $username);

        $stmt->execute($data);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row){

            $user = new User(
                $row['id'],
                $row['username'],
                $row['password'],
                $row['nombre'],
                $row['apellidos'],
                $row['email'],
                ''
            );

            $stmt = $this->db->prepare('SELECT * FROM user_roles WHERE
                                        user_id = :user_id');

            $stmt->execute(array(':user_id' => $user->id));

            $roles = [];
           
            while($row2 = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $roles[] = $row2['roles'];            
             }
            $user->roles = $roles;

            
            return $user;
            
        }else{echo 'Usuario no encontrado en la Base de datos';}

    }



}