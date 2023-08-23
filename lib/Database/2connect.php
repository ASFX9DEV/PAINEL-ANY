<?php
 define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'seudbuseraqui');
define('DB_PASSWORD', 'seudbpassaqui');
define('DB_NAME', 'seudbnameaqui');

/* Tentativa de conexão com o banco de dados MySQL */
try{
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
 //selecionando o banco de dados 
$db = mysqli_select_db($mysqli, DB_NAME);
} catch(PDOException $e){
    die("ERROR: Não foi possível conectar." . $e->getMessage());
}
try{
   
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Defina o modo de erro PDO para exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Não foi possível conectar." . $e->getMessage());
}
?>