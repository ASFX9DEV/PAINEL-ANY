<?php 
session_start();
error_reporting(1);
ini_set('display_errors',1 );
define( 'TITLE','Configurações AnyMOD');
define( 'LINK','index.php?p=configany');
define( 'ROOT',dirname( __FILE__ ) );
define( 'VIEW',ROOT .'/app/views');
define( 'VIEWS',LINK .'/app/views');
;