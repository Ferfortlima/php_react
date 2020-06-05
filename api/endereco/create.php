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
  
$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->numero) &&
    !empty($data->idcliente) &&
    !empty($data->rua) &&
    !empty($data->cep) &&
    !empty($data->bairro) &&
    !empty($data->cidade) &&
    !empty($data->estado)
){

    $endereco->numero = $data->numero;
    $endereco->idcliente = $data->idcliente;
    $endereco->rua = $data->rua;
    $endereco->cep = $data->cep;
    $endereco->bairro = $data->bairro;
    $endereco->cidade = $data->cidade;
    $endereco->estado = $data->estado;
  
    if($endereco->create()){
  
        http_response_code(201);
  
        echo json_encode(array("message" => "Endereco cadastrado."));
    }
  
    else{
  
        http_response_code(503);
  
        echo json_encode(array("message" => "Erro ao cadastrar endereco."));
    }
}
  
else{
  
    http_response_code(400);
  
    echo json_encode(array("message" => "Dados insuficientes para cadastrar endereco."));
}
?>