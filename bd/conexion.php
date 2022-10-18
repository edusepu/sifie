<?php 
    class Conexion{
        public static function Conectar() {
            //define('servidor', '10.24.32.45');
            define('servidor', 'localhost');
            define('nombre_bd', 'efectos');
            //define('usuario', 'root');
            define('usuario', 'sepu');
            define('password', '1q2w3e4r');
            //define('password', '');
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            try{
                $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);
                return $conexion;
            }catch (Exception $e){
                die("El error de Conexión es: ". $e->getMessage());
            }
        }
    }