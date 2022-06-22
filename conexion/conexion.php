<?php

class Conectar{

    public static function Conexion(){
        try{
            if(file_exists("./conexion/bbdd.php") || file_exists("conexion/bbdd.php")){
                require_once("bbdd.php");
                $conexion = new PDO("mysql:host=".HOST."; dbname=".DBNAME,USER,PASS);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexion->exec("SET CHARACTER SET utf8");
                return $conexion;
            }else{
                return "<p>No se ha podido conectar con la BBDD</p>";
            }
        }catch(PDOException $e){
            return self::mensajes($e->getCode());
        }
    }

    public static function Pruebaconexion(){
        try{
            require_once("bbdd.php");
            $conexion = new PDO("mysql:host=".HOST,USER,PASS); //Conectar::Conexion();
            return $conexion;
        }catch(PDOException $e){
            return self::mensajes($e->getCode());
        }

    }

    public static function mensajes($e){
        switch($e){
            case "2002":
                if(file_exists("conexion/bbdd.php")){
                    return "<p class='error-form'>Error al conectar!! El host es incorrecto: (" . $e.")</p>";
                }else{
                    return "<p class='warning-form'>No cuenta con los recursos* para conectar con la base de datos. En la página de inicio podrá ver los pasos a seguir para generar los recursos necesarios.<br><small>*Si ya generó los recursos, revise que los datos sean correctos.</small></p>";
                }
                break;
            case "1049":
                return "<p class='error-form'>Error al conectar!! No se encuentra la Base de datos: (" . $e.")</p>";
                break;
            case "1045":
                return "<p class='error-form'>Error al conectar!! Usuario y/o Contraseña incorrecta: (" . $e.")</p>";
                break;
            case "42000":
                return "<p class='error-form'>Error al conectar!! Usuario y/o Contraseña incorrecta: (" . $e.")</p>";
                break;
            case "42S02":
                return "<p class='error-form'>Error en la consulta!! No se encuentra la Tabla en la DDBB: (" . $e.")</p>";
                break;
            case "23000":
                return "<p class='error-form'>Ya existe el usuario o el email introducido: (" . $e.")</p>";
                break;
            default:
                return "<p class='error-form'>Error al conectar!! ERROR INESPERADO ".$e."</p>";
        }
    }
}
