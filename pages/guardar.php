<?php
    header("Content-Type: application/json");
    $file = "../data/json/datos.json";

    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) {
        echo json_encode(["success" => false, "message" => "No se recibieron datos."]);
        exit;
    }
    $datos = [];

    if (file_exists($file)) {
        $datos = json_decode(file_get_contents($file), true);
        if (!$datos) {
            $datos = [];
        }
    }
    $desId = count($datos) > 0 ? end($datos)["id"] + 1 : 1;
    $nuevodato = [
        "id" => $desId,
        "titulo" => $data["titulo"],
        "fecha" => $data["fecha"],
        "hora" => $data["hora"],
        "categoria" => $data["categoria"],
        "descripcion" => $data["descripcion"],
    ];
    $datos[] = $nuevodato;
    if (file_put_contents($file, json_encode($datos, JSON_PRETTY_PRINT))) {
        echo json_encode(["success" => true, "message" => "Datos guardados correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "No se pudieron guardar los datos."]);
    }
?>