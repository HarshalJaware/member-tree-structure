<?php
/**
*Database class
*Handles the database connection using PDO
*Implements the Singleton Design Pattern
**Database connection created in this class
**singelton design pattern is used
*/
class Database{
    public static $pdo = null;

    //Database configuration
    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $dbname = "member_tree_app";

    public static function getInstance(){
      if(self::$pdo === null){
        try{
            self::$pdo = new PDO(
                "mysql:host=" . self::$servername . ";dbname=" . self::$dbname . ";",
                self::$username,
                self::$password
            );
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           //echo "Datbase is connected successfully";
        }catch(PDOException  $e){
            die("DB Connection failed: " . $e->getMessage());
        }
      }  
      
      return self::$pdo;
    }
}
?>