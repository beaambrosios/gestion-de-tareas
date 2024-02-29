<?php
 
define('HOST', 'localhost');
define('USER', 'root'); 
define('PASSWORD', ''); 
define('DATABASE', 'gestion_tareas'); 
 
 
function DB()
{
    static $instance;
    if ($instance === null) {
        try {
            $opt = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => FALSE,
            );
            $dsn = 'mysql:host=' . HOST . ';dbname=' . DATABASE;
            $instance = new PDO($dsn, USER, PASSWORD, $opt);
        } catch (PDOException $e) {
            // Manejar errores de conexión aquí
            echo 'Error de conexión: ' . $e->getMessage();
            exit; 
        }
    }
    return $instance;
}
?>
