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
include_once '../objects/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->nome) &&
    !empty($data->data_nascimento) &&
    !empty($data->cpf) &&
    !empty($data->rg) &&
    !empty($data->idusuario) &&
    !empty($data->telefone)
) {

    $cliente->id = $data->id;

    $cliente->nome = $data->nome;
    $cliente->idusuario = $data->idusuario;
    $cliente->data_nascimento = $data->data_nascimento;
    $cliente->cpf = $data->cpf;
    $cliente->rg = $data->rg;
    $cliente->telefone = $data->telefone;

    if ($cliente->update()) {

        http_response_code(200);

        echo json_encode(array("message" => "Dados do cliente atualizado."));
    } else {

        http_response_code(503);

        echo json_encode(array("message" => "Não foi possível atualizar dados do cliente."));
    }
} else {

    http_response_code(400);

    echo json_encode(array("message" => "Dados insuficientes para cadastrar cliente."));
}
