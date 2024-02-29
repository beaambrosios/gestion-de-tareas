<?php

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['tarea'])) {

    require __DIR__ . '/library.php';
    $nombre     = (isset($data['tarea']['nombre']) ? $data['tarea']['nombre'] : NULL);
    $completada = (isset($data['tarea']['completada']) ? $data['tarea']['completada'] : NULL);
    $id         = (isset($data['tarea']['id']) ? $data['tarea']['id'] : NULL);

    // validar
    if ($nombre == NULL) {
        http_response_code(400);
        echo json_encode(['errors' => ["El campo de nombre es obligatorio"]]);
    } else {

        // Update
        $crud = new Crud();

        $crud->Update($nombre, $completada, $id);
    }
}
?>