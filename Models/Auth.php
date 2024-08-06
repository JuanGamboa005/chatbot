<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');


//conexión a la BD
require_once "../config/conexion.php";


Class Auth{
    
    public function iniciarSesion($email, $password){

        $con= " SELECT email, nickName
                FROM usuarios 
                WHERE email= '$email'
                AND password= '$password'";


        // return var_dump($con);
        $sql=  ejecutarConsultaSimpleFila($con);

        if($sql) return array("1", "Registro Exitoso", $sql);
        return array("", "Datos errados");
    }


    public function crearUsuario($nickName, $email, $password){

        $comprobarEmail = $this->mostrarEmail($email);

        // return var_dump($comprobarEmail["email"]);
        if( !is_null($comprobarEmail)){
            return array("", "El Email ya esta en uso");

        }

        $con= " INSERT INTO usuarios
                (nickName, email, password)
                VALUES
                ('$nickName', '$email', '$password')";

        
        if(ejecutarConsulta($con)) {
            return array("1", "registro reazlizado");
        }else{
            return array("", "error el la ejecución");
        }
            
    }

    public function mostrarEmail($email){

        $con= " SELECT email
                FROM usuarios 
                WHERE email= '$email' ";

        return ejecutarConsultaSimpleFila($con);

    }


}