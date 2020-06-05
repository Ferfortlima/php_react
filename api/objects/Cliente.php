<?php
class Cliente
{

    private $conn;
    private $table_name = "clientes";

    public $id;
    public $idusuario;
    public $nome;
    public $data_nascimento;
    public $cpf;
    public $rg;
    public $telefone;
    public $enderecos;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function read()
    {

        $query = "SELECT id as idcliente, idusuario, nome, data_nascimento, cpf, rg, telefone
        FROM clientes
        WHERE idusuario =:idusuario;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":idusuario", $this->idusuario, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt;
    }
    public function create()
    {

        $query = "INSERT INTO clientes  SET
        nome=:nome,
        idusuario=:idusuario,
        data_nascimento=:data_nascimento,
        cpf=:cpf,
        rg=:rg,
        telefone=:telefone;";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":idusuario", $this->idusuario, PDO::PARAM_INT);
        $stmt->bindValue(":data_nascimento", $this->data_nascimento);
        $stmt->bindValue(":cpf", $this->cpf);
        $stmt->bindValue(":rg", $this->rg);
        $stmt->bindValue(":telefone", $this->telefone);

        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    public function readOne()
    {

        $query = "SELECT c.id,c.idusuario, c.nome, c.data_nascimento, c.cpf, c.rg, c.telefone FROM clientes c
                WHERE c.id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nome = $row['nome'];
        $this->idusuario = $row['idusuario'];
        $this->data_nascimento = $row['data_nascimento'];
        $this->cpf = $row['cpf'];
        $this->rg = $row['rg'];
        $this->telefone = $row['telefone'];
    }

    public function update()
    {

        $query = "UPDATE clientes
                SET nome=:nome,
                data_nascimento=:data_nascimento,
                idusuario=:idusuario,
                cpf=:cpf,
                rg=:rg,
                telefone=:telefone
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':idusuario', $this->idusuario);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':rg', $this->rg);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {

        $query = "DELETE FROM clientes WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
