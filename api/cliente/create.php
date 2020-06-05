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
include_once '../objects/Endereco.php';

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

    $cliente->nome = $data->nome;
    $cliente->idusuario = $data->idusuario;
    $cliente->data_nascimento = $data->data_nascimento;
    $cliente->cpf = $data->cpf;
    $cliente->rg = $data->rg;
    $cliente->telefone = $data->telefone;

    if ($cliente->create()) {

        $last_id = $db->lastInsertId();
        if (!empty($data->enderecos)) {
            foreach ($data->enderecos as $item) {
                $end = $item;
                $endereco = new Endereco($db);
                $endereco->numero = $end->numero;
                $endereco->idcliente = $last_id;
                $endereco->rua = $end->rua;
                $endereco->cep = $end->cep;
                $endereco->bairro = $end->bairro;
                $endereco->cidade = $end->cidade;
                $endereco->estado = $end->estado;
                $endereco->create();

            }
        }
        http_response_code(201);

        echo json_encode(array("message" => "Cliente cadastrado."));
    } else {

        http_response_code(503);

        echo json_encode(array("message" => "Erro ao cadastrar cliente."));
    }
} else {

    http_response_code(400);

    echo json_encode(array("message" => "Dados insuficientes para cadastrar cliente."));
}
