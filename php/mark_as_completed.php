<?php

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['id']) && isset($data['completada'])) {
    require __DIR__ . '/library.php';

    $id = $data['id'];
    $completada = intval($data['completada']);

    $crud = new Crud();
    $crud->markAsCompleted($id, $completada);

    echo json_encode(['message' => 'Estado de la tarea actualizado correctamente']);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Parámetros incorrectos']);
}

?>