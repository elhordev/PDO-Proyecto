<?php

namespace services;

/**
 * Class SessionService
 * @package services
 * Esta clase se encarga de gestionar la sesión de usuario
 */
class SessionService
{
    private static $instance;
    private $expireAfterseconds = 3600;


    private function __construct(){

        $this->expire();

    }

    public static function getInstance():SessionService{

        if (!isset(self::$instance)){
            self::$instance = new SessionService();
        }
        return self::$instance;

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
            echo 'Llego aquí3';
            $_SESSION['rol'] = 'ADMIN';

        }else{
            $_SESSION['rol'] = $roles[0];
        }
            $_SESSION['lastMove'] = time();
            $_SESSION['user_logged'] = true;


            setcookie("usuario", $_SESSION['usuario'],time() + $this->expireAfterseconds,"/");
            
            setcookie("rol",$_SESSION['rol'], time() + $this->expireAfterseconds, "/");
            echo $_SESSION['rol'];

    }

    public function logout(){
            setcookie("usuario", $_SESSION['usuario'],time() -3600);
            setcookie("rol",$_SESSION['rol'], time() -3600);
            session_destroy();
    }

    public function expire(){
            
            $ahora = time();
            $tiempoensesion = 0
            ;
            if(isset($_SESSION['lastMove']) && isset($_SESSION['user_logged'])){

                $tiempoensesion = $ahora - $_SESSION['lastMove'];
                if($tiempoensesion > $this->expireAfterseconds){
                    $this->logout();
                    header('location:../public/index.php');}
                    echo "Sesión cerrada, ha superado el límite de tiempo inactivo";  
            }
            
               



    }
}

?>