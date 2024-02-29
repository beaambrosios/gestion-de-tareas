<?php

//este codigo se encarga de registrar un producto 
$data = json_decode(file_get_contents('php://input'), TRUE);

// Imprimir los datos recibidos
echo 'Datos recibidos: ';
var_dump($data);

if (isset($data['tarea'])) {

    require __DIR__ . '/library.php';

    $nombre = (isset($data['tarea']['nombre']) ? $data['tarea']['nombre'] : NULL);
    $completada = (isset($data['tarea']['completada']) ? $data['tarea']['completada'] : NULL);

    if ($nombre == NULL) {

        http_response_code(400);
        echo json_encode(['errors' => ["El campo de nombre es obligatorio"]]);
    } else {

        $crud = new Crud();
        echo $crud->Create($nombre, $completada);
    }
}
 
 