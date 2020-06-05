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
include_once '../objects/Usuario.php';
 
$database = new Database();
$db = $database->getConnection();
 
$usuario = new Usuario($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$usuario->nome = $data->nome;
$usuario->email = $data->email;
$usuario->senha = $data->senha;
 
if(
    !empty($usuario->nome) &&
    !empty($usuario->email) &&
    !empty($usuario->senha) &&
    $usuario->create()
){
 
    http_response_code(200);
 
    echo json_encode(array("message" => "Usuário criado com sucesso."));
}
 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Não foi possível criar o usuário."));
}
?>