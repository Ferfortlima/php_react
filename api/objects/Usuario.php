<?php
class Usuario
{

    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $nome;
    public $email;
    public $senha;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    function create(){
 
        $query = "INSERT INTO usuarios
                SET nome = :nome,
                    email = :email,
                    senha = :senha;";
     
        $stmt = $this->conn->prepare($query);
     
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->senha=htmlspecialchars(strip_tags($this->senha));
     
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
     
        $password_hash = password_hash($this->senha, PASSWORD_BCRYPT);
        $stmt->bindParam(':senha', $password_hash);
     
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }
    public function emailExists()
    {

        $query = "SELECT id, nome, email, senha FROM usuarios
                WHERE email = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->email);

        $stmt->execute();

        $num = $stmt->rowCount();

        if ($num > 0) {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->nome = $row['nome'];
            $this->email = $row['email'];
            $this->senha = $row['senha'];

            return true;
        }

        return false;
    }
}
