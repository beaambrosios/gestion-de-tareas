<?php

require __DIR__ . '/database_connection.php';

class Crud {

    protected $db;

    public function __construct() {
        $this->db = DB();
    }

    public function Read() {
        $query = $this->db->prepare("SELECT * FROM tareas");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return json_encode(['tareas' => $data]);
    }

    public function Create($nombre, $completada) {
        $query = $this->db->prepare("INSERT INTO tareas(nombre, completada) VALUES (:nombre,:completada)");
        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam("completada", $completada, PDO::PARAM_STR);
        $query->execute();

        return json_encode(['tarea' => [
                'id' => $this->db->lastInsertId(),
                'nombre' => $nombre,
                'completada' => $completada
        ]]);
    }

    public function Delete($id) {
        $query = $this->db->prepare("DELETE FROM tareas WHERE id = :id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
    }

    public function Update($nombre, $completada, $id) {
        $query = $this->db->prepare("UPDATE tareas SET nombre = :nombre, completada = :completada WHERE id = :id");
        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam("completada", $completada, PDO::PARAM_STR);
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
    }

    public function markAsCompleted($id, $completada) {
        $query = $this->db->prepare("UPDATE tareas SET completada = :completada WHERE id = :id");
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->bindParam(":completada", $completada, PDO::PARAM_INT);
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }



}

?>