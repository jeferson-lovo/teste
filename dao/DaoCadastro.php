<?php 
require_once(__DIR__ . '/../model/Cadastro.php');
require_once(__DIR__ . '/../db/Db.php');

// Classe cadastro generico
// DAO - Data Access Object
class DaoCadastro {
    
  private $connection;

  public function __construct(Db $connection) {
      $this->connection = $connection;
  }
  
  public function porId(int $id): ?Cadastro {
    $sql = "SELECT nome, descricao, cidade_fab, valor, quantidade,  FROM cadastros where id = ?";
    $stmt = $this->connection->prepare($sql);
    $cad = null;
    if ($stmt) {
      $stmt->bind_param('i',$id);
      if ($stmt->execute()) {
        $nome=''; $descricao=''; $cidade_fab=''; $valor=0.0; $quantidade=0;
        $stmt->bind_result($nome, $descricao, $cidade_fab, $valor, $quantidade);
        $stmt->store_result();
        if ($stmt->num_rows == 1 && $stmt->fetch()) {
          $cad = new Cadastro ($nome, $descricao, $cidade_fab, $valor, $quantidade, $id);
        }
      }
      $stmt->close();
    }
    return $cad;
  }

  public function inserir(Cadastro $cadastro): bool {
    $sql = "INSERT INTO cadastros (nome,descricao,cidade_fab, valor,quantidade) VALUES(?,?,?,?,?)";
    $stmt = $this->connection->prepare($sql);
    $res = false;
    if ($stmt) {
      $nome = $cadastro->getNome();
      $descricao = $cadastro->getDescricao();
      $cidade_fab = $cadastro->getCidade_fab();
      $valor = $cadastro->getValor();
      $quantidade = $cadastro->getQuantidade();
      $stmt->bind_param('sssdi', $nome, $descricao, $cidade_fab, $valor, $quantidade);
      if ($stmt->execute()) {
          $id = $this->connection->getLastID();
          $cadastro->setId($id);
          $res = true;
      }
      $stmt->close();
    }
    return $res;
  }

  public function remover(Cadastro $cadastro): bool {
    $sql = "DELETE FROM cadastros where id=?";
    $id = $cadastro->getId(); 
    $stmt = $this->connection->prepare($sql);
    $ret = false;
    if ($stmt) {
      $stmt->bind_param('i',$id);
      $ret = $stmt->execute();
      $stmt->close();
    }
    return $ret;
  }

  public function atualizar(Cadastro $cadastro): bool {
    $sql = "UPDATE cadastros SET nome = ?, descricao = ?, cidade_fab = ?, valor = ?, quantidade = ? WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $ret = false;      
    if ($stmt) {
      $id = $cadastro->getId();
      $nome = $cadastro->getNome();
      $descricao = $cadastro->getDescricao();
      $cidade_fab = $cadastro->getCidade_fab();
      $valor = $cadastro->getValor();
      $quantidade = $cadastro->getQuantidade();
      $stmt->bind_param('sssdii', $nome, $descricao, $cidade_fab, $valor, $quantidade, $id);
      $ret = $stmt->execute();
      $stmt->close();
    }
    return $ret;
  }

  
  public function todos(): array {
    $sql = "SELECT id, nome, descricao, cidade_fab, valor, quantidade from cadastros";
    $stmt = $this->connection->prepare($sql);
    $cadastro = [];
    if ($stmt) {
      if ($stmt->execute()) {
        $id = 0; 
        $nome = '';
        $descricao = '';
        $cidade_fab = '';
        $valor = 0.0;
        $quantidade = 0;
        $stmt->bind_result($id, $nome, $descricao, $cidade_fab, $valor, $quantidade);
        $stmt->store_result();
        while($stmt->fetch()) {
          $cadastro [] = new Cadastro ($nome, $descricao, $cidade_fab, $valor, $quantidade, $id);
        }
      }
      $stmt->close();
    }
    return $cadastro;
  }

};
