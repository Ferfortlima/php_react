<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, origin");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}
include_once '../conf/Database.php';
include_once '../objects/Endereco.php';

$database = new Database();
$db = $database->getConnection();

$endereco = new Endereco($db);
if (isset($_GET['id'])) {
    $endereco->id = $_GET['id'];

    $endereco->readOne();

    if ($endereco->cep != null) {

        $endereco_list = array(
            "id" => $endereco->id,
            "idcliente" => $endereco->idcliente,
            "numero" => $endereco->numero,
            "rua" => $endereco->rua,
            "cep" => $endereco->cep,
            "bairro" => $endereco->bairro,
            "cidade" => $endereco->cidade,
            "estado" => $endereco->estado,
        );

        http_response_code(200);

        echo json_encode($endereco_list);

    } else {

        http_response_code(404);

        echo json_encode(array("message" => "Endereço não encontrado."));
    }
} else {

    $stmt = $endereco->read();
    $num = $stmt->rowCount();

    if ($num > 0) {

        $endereco_list = array();
        $endereco_list["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $endereco_item = array(
                "id" => $id,
                "idcliente" => $idcliente,
                "rua" => $rua,
                "cep" => $cep,
                "bairro" => $bairro,
                "cidade" => $cidade,
                "estado" => $estado,
                "numero" => $numero,
            );

            array_push($endereco_list["records"], $endereco_item);
        }

        http_response_code(200);

        echo json_encode($endereco_list);
    } else {

        http_response_code(404);

        echo json_encode(
            array("message" => "Nenhum endereco encontrado.")
        );
    }
}
