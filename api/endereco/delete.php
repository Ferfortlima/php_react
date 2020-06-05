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
include_once '../conf/database.php';
include_once '../objects/Endereco.php';
  
$database = new Database();
$db = $database->getConnection();
  
$endereco = new Endereco($db);
  
$data = json_decode(file_get_contents("php://input"));
  
$endereco->id = $data->id;
  
if($endereco->delete()){
  
    http_response_code(200);
  
    echo json_encode(array("message" => "Endereco removido com sucesso."));
}
  
else{
  
    http_response_code(503);
  
    echo json_encode(array("message" => "Não foi possível remover o endereco."));
}
?>