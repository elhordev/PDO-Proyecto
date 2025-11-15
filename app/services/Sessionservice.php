<?php

namespace services;

/**
 * Class SessionService
 * @package services
 * Esta clase se encarga de gestionar la sesión de usuario
 */
class SessionService
{

    private $expireAfterseconds = 3600;


    private function __construct(){

    }

    public static function getInstance(){

    }

    public function login($user){
        //Iniciar la sesión
        session_start();

        //Variables de sesión
        $_SESSION['usuario'] = $user->username;
        
        $roles = [];

        foreach($user->roles as $rol){
            $roles[] = $rol;
        }
        if(in_array('ADMIN',$roles)){

            $_SESSION = 'ADMIN';

        }else{
            $_SESSION['rol'] = $roles[0];
        }
            $_SESSION['lastMove'] = time();


    }

    public function logout(){

    }

    public function expire(){
        $ahora = time();

        



    }
}

?>