<?php
// BANCO DE DADOS È EM 2CONNECT.PHP
// BANCO DE DADOS È EM 2CONNECT.PHP
// BANCO DE DADOS È EM 2CONNECT.PHP
// BANCO DE DADOS È EM 2CONNECT.PHP
// BANCO DE DADOS È EM 2CONNECT.PHP


abstract class Connection
{
    private static $conn;

    public static function getConn()
    {
        if (self::$conn == null) {
            try {
                 require_once 'lib/Database/2connect.php';
                $dbhost = DB_SERVER; 
                $dbuser = DB_USERNAME; 
                $dbpass = DB_PASSWORD;
                $dbname = DB_USERNAME;

                self::$conn = new PDO(
                    "mysql:host=$dbhost;dbname=$dbname",
                    $dbuser,
                    $dbpass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                );
            } catch (PDOException $e) {
                echo "<center><h2>Banco de dados sem conexão, verifique o arquivo <b>lib/Database/Connection.php</b><br>" . $e->getMessage();
                exit;
            }
        }
        return self::$conn;
    }
}
