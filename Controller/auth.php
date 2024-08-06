<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once "../Models/Auth.php";

    $_GET["op"]();

    function crearUsuario(){

        $auth= new Auth();
        
        
        $nickName   =isset($_POST["register-nombre"])   ? limpiarCadena($_POST["register-nombre"])  :"";
        $email      =isset($_POST["register-email"])    ? limpiarCadena($_POST["register-email"])   :"";
        $password   =isset($_POST["register-password"]) ? limpiarCadena($_POST["register-password"]):"";
            
        if($nickName=="" || $email=="" || $password==""){

            echo json_encode(array("", "Alguno de los campos esta vacío"));
            return;
        }


        $password = SHA1($password);
        $rpta=  $auth->crearUsuario($nickName, $email, $password);
        echo json_encode($rpta);

    }

    function iniciarSesion(){

        $auth= new Auth();
        
        
        $email      =isset($_POST["login-email"])    ? limpiarCadena($_POST["login-email"])   :"";
        $password   =isset($_POST["login-password"]) ? limpiarCadena($_POST["login-password"]):"";
            
        $password = SHA1($password);
        $rpta=  $auth->iniciarSesion($email, $password);
        echo json_encode($rpta);
    
    }
?>

