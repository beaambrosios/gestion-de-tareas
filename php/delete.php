<?php

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['tarea'])) {

    require __DIR__ . '/library.php';

    $codigo = (isset($data['tarea']['id']) ? $data['tarea']['id'] : NULL);

    if ($codigo == NULL) {
        http_response_code(400);
        echo json_encode(['errors' => ["No se pudo eliminar el tarea"]]);
    } else {

        // Delete
        $crud = new Crud();

        $crud->Delete($codigo);
    }
}
?>