<?php
class Endereco
{

    private $conn;
    private $table_name = "enderecos";

    public $id;
    public $idcliente;
    public $numero;
    public $rua;
    public $cep;
    public $bairro;
    public $cidade;
    public $estado;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function read()
    {

        $query = "SELECT id, idcliente, numero, rua, cep, bairro, cidade, estado FROM enderecos;";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
    public function create()
    {

        $query = "INSERT INTO enderecos
         SET idcliente=:idcliente,
        rua=:rua,
        cep=:cep,
        bairro=:bairro,
        cidade=:cidade,
        estado=:estado,
        numero=:numero;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":numero", $this->numero);
        $stmt->bindValue(":idcliente", $this->idcliente, PDO::PARAM_INT);
        $stmt->bindValue(":rua", $this->rua);
        $stmt->bindValue(":cep", $this->cep);
        $stmt->bindValue(":bairro", $this->bairro);
        $stmt->bindValue(":cidade", $this->cidade);
        $stmt->bindValue(":estado", $this->estado);

        if ($stmt->execute()) {
            return true;
        }
        return false;

    }

    public function readOne()
    {

        $query = "SELECT id, idcliente, numero, rua, cep, bairro, cidade, estado FROM enderecos
                WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->idcliente = $row['idcliente'];
        $this->numero = $row['numero'];
        $this->rua = $row['rua'];
        $this->cep = $row['cep'];
        $this->bairro = $row['bairro'];
        $this->cidade = $row['cidade'];
        $this->estado = $row['estado'];
    }
    public function readByIdClient($idcliente)
    {
        $query = "SELECT id, idcliente, numero, rua, cep, bairro, cidade, estado FROM enderecos
                WHERE idcliente = :idcliente";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":idcliente", $idcliente);

        $stmt->execute();

        return $stmt;
    }

    public function update()
    {

        $query = "UPDATE enderecos
                SET numero=:numero,
                idcliente=:idcliente,
                rua=:rua,
                cep=:cep,
                bairro=:bairro,
                cidade=:cidade,
                estado=:estado
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":idcliente", $this->idcliente);
        $stmt->bindParam(":rua", $this->rua);
        $stmt->bindParam(":cep", $this->cep);
        $stmt->bindParam(":bairro", $this->bairro);
        $stmt->bindParam(":cidade", $this->cidade);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {

        $query = "DELETE FROM enderecos WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
