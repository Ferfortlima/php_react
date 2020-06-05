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
$endereco = new Endereco($db);

if (isset($_GET['idusuario'])) {
    $cliente->idusuario = $_GET['idusuario'];

    $stmt = $cliente->read();
    $num = $stmt->rowCount();

    if ($num > 0) {

        $cliente_list = array();
        $cliente_list["clientes"] = array();
        $endereco_list = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $enderecos = array();

            extract($row);

            $endereco_list = $endereco->readByIdClient($idcliente);

            while ($row_address = $endereco_list->fetch(PDO::FETCH_ASSOC)) {
                extract($row_address);
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

                array_push($enderecos, $endereco_item);
            }

            $cliente_item = array(
                "id" => $idcliente,
                "nome" => $nome,
                "idusuario" => $idusuario,
                "data_nascimento" => $data_nascimento,
                "cpf" => $cpf,
                "rg" => $rg,
                "telefone" => $telefone,
                "enderecos" => $enderecos,

            );

            array_push($cliente_list["clientes"], $cliente_item);
        }

        http_response_code(200);

        echo json_encode($cliente_list);
    } else {

        http_response_code(404);

        echo json_encode(
            array("message" => "Nenhum cliente encontrado.")
        );
    }
} else if (isset($_GET['id'])) {
    $cliente->id = $_GET['id'];

    $cliente->readOne();

    if ($cliente->nome != null) {

        $addresses = $endereco->readByIdClient($cliente->id);
        $endereco_list = array();

        while ($row = $addresses->fetch(PDO::FETCH_ASSOC)) {
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

            array_push($endereco_list, $endereco_item);
        }
        $cliente_list = array(
            "id" => $cliente->id,
            "nome" => $cliente->nome,
            "idusuario" => $cliente->idusuario,
            "data_nascimento" => $cliente->data_nascimento,
            "cpf" => $cliente->cpf,
            "rg" => $cliente->rg,
            "telefone" => $cliente->telefone,
            "enderecos" => $endereco_list,
        );

        http_response_code(200);

        echo json_encode($cliente_list);

    } else {

        http_response_code(404);

        echo json_encode(array("message" => "Cliente não encontrado."));
    }
} else {

    $stmt = $cliente->read();
    $num = $stmt->rowCount();

    if ($num > 0) {

        $cliente_list = array();
        $cliente_list["clientes"] = array();
        $endereco_list = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $enderecos = array();

            extract($row);

            $endereco_list = $endereco->readByIdClient($idcliente);

            while ($row_address = $endereco_list->fetch(PDO::FETCH_ASSOC)) {
                extract($row_address);
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

                array_push($enderecos, $endereco_item);
            }

            $cliente_item = array(
                "id" => $idcliente,
                "nome" => $nome,
                "idusuario" => $idusuario,
                "data_nascimento" => $data_nascimento,
                "cpf" => $cpf,
                "rg" => $rg,
                "telefone" => $telefone,
                "enderecos" => $enderecos,

            );

            array_push($cliente_list["clientes"], $cliente_item);
        }

        http_response_code(200);

        echo json_encode($cliente_list);
    } else {

        http_response_code(404);

        echo json_encode(
            array("message" => "Nenhum cliente encontrado.")
        );
    }
}
