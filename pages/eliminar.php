<?php
    header("Content-Type: application/json");

    $file = "../data/json/datos.json";

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'])) {
        echo json_encode(["success" => false, "message" => "Error!! No se recibió el ID."]);
        exit;
    }

    $ideliminar = (int) $data['id'];

    if (!file_exists($file)) {
        echo json_encode(["success" => false, "message" => "Correcto!! Archivo de datos no encontrado."]);
        exit;
    }

    $datos = json_decode(file_get_contents($file), true);

    if (!$datos || !is_array($datos)) {
        echo json_encode(["success" => false, "message" => "Error!! al cargar los datos."]);
        exit;
    }

    $filtrar = array_filter($datos, function ($entry) use ($ideliminar) {
        return (int) $entry['id'] !== $ideliminar;
    });

    if (count($datos) === count($filtrar)) {
        echo json_encode(["success" => false, "message" => "Error!! ID no encontrado."]);
        exit;
    }

    if (file_put_contents($file, json_encode(array_values($filtrar), JSON_PRETTY_PRINT))) {
        echo json_encode(["success" => true, "message" => "Dato eliminada correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error!! al guardar los datos."]);
    }
?>
