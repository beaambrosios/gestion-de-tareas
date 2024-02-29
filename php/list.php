<?php
require __DIR__ . '/library.php';
 
$tareas = new Crud();
 
echo $tareas->Read();
 
?>