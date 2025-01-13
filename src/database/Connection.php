<?php

class Connection{
    
    private static $host = 'mysql:host=localhost;dbname=chatsimples;charset=utf8mb4';
    private static $user =  'root';
    private static $password = '';
    private static $options =[ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] ;
    private static $conn = null;
    
    public static function connection(){
        try{
            if(self::$conn === null){
                self::$conn = new PDO(self::$host, 
                self::$user, 
                self::$password, 
                self::$options);
            }
        }catch(PDOException $e){
            echo "error: " . $e->getMessage();
        }
        return self::$conn;
    }
    // private function __construct() {}
    // private function __clone() {}
}

