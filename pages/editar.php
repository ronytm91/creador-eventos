<?php
    header("Content-Type: application/json");
    $file = "../data/json/datos.json";
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data || !isset($data['id'])) {
        echo json_encode(["success" => false, "message" => "Datos inválidos."]);
        exit;
    }
    if (!file_exists($file)) {
        echo json_encode(["success" => false, "message" => "Archivo de datos no encontrado."]);
        exit;
    }
    $datos = json_decode(file_get_contents($file), true);

    if (!$datos || !is_array($datos)) {
        echo json_encode(["success" => false, "message" => "Formato de datos inválido."]);
        exit;
    }

    $modificar = false;
    foreach ($datos as &$entry) {
        if ($entry['id'] === $data['id']) {
            $entry['titulo'] = $data['titulo'];
            $entry['fecha'] = $data['fecha'];
            $entry['hora'] = $data['hora'];
            $entry['categoria'] = $data['categoria'];
            $entry['descripcion'] = $data['descripcion'];
            $modificar = true;
            break;
        }
    }

    if (!$modificar) {
        echo json_encode(["success" => false, "message" => "No se encontró el ID."]);
        exit;
    }

    if (file_put_contents($file, json_encode($datos, JSON_PRETTY_PRINT))) {
        echo json_encode(["success" => true, "message" => "Datos actualizados correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "No se pudieron guardar los datos."]);
    }

?>
