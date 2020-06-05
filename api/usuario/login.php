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
include_once '../objects/Usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$data = json_decode(file_get_contents("php://input"));

$usuario->email = $data->email;
$email_exists = $usuario->emailExists();

include_once '../conf/Core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

if ($email_exists && password_verify($data->senha, $usuario->senha)) {

    $token = array(
        "iss" => $iss,
        "aud" => $aud,
        "iat" => $iat,
        "nbf" => $nbf,
        "data" => array(
            "id" => $usuario->id,
            "nome" => $usuario->nome,
            "email" => $usuario->email,
        ),
    );

    http_response_code(200);

    $jwt = JWT::encode($token, $key);
    echo json_encode(
        array(
            "message" => "Bem vindo " . $usuario->nome,
            'usuario' => array("id" => $usuario->id,
                "nome" => $usuario->nome,
                "email" => $usuario->email),
            "jwt" => $jwt,
        )
    );

} else {

    http_response_code(401);

    echo json_encode(array("message" => "Usuário ou senha incorretos"));
}
