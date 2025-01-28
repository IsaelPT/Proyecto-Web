<?php

class DataBase{
    const server = "localhost";
    const user = "root";
    const password = "";
    const dbname = "hospital";

    public static function connect(){
        try{
            $connexion = new PDO("mysql:host=".self::server.";dbname=".self::dbname.";charset=utf8",self::user,self::password);
            $connexion -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $connexion;
        }catch(PDOException $e){
            return "Fallo ".$e->getMessage();
        }
    }
}
