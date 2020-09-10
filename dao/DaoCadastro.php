<?php 
require_once(__DIR__ . '/../model/Cadastro.php');
require_once(__DIR__ . '/../db/Db.php');

class DaoCadastro {
    
  private $connection;

  public function __construct(Db $connection) {
      $this->connection = $connection;
  }
  
  public function porId(int $id): ?cadastro {
    $sql = "SELECT nome, descricao, valor, quantidade FROM cadastros where id = ?";
    $stmt = $this->connection->prepare($sql);
    $cad = null;
    if ($stmt) {
      $stmt->bind_param('i',$id);
      if ($stmt->execute()) {
        $nome = '';$descricao=''; $valor=0.0; $quantidade=0;
        $stmt->bind_result($nome, $descricao, $valor, $quantidade);
        $stmt->store_result();
        if ($stmt->num_rows == 1 && $stmt->fetch()) {
          $cad = new Cadastro($id, $nome, $descricao, $valor, $quantidade);
        }
      }
      $stmt->close();
    }
    return $cad;
  }

  public function inserir(cadastro $cadastro): bool {
    $sql = "INSERT INTO cadastros (nome, descricao, valor, quantidade) VALUES(?,?,?,?)";
    $stmt = $this->connection->prepare($sql);
    $res = false;
    if ($stmt) {
      $nome = $cadastro->getNome();
      $descricao = $cadastro->getDescricao();
      $valor = $cadastro->getValor();
      $quantidade = $cadastro->getQuantidade();
      $stmt->bind_param('ssdi', $nome, $descricao, $valor, $quantidade);
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
    $sql = "UPDATE cadastros SET nome = ?, descricao = ?, valor = ?, quantidade = ? WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $ret = false;      
    if ($stmt) {
      $nome = $cadastro->getNome();
      $id   = $cadastro->getId();
      $descricao   = $cadastro->getDescricao();
      $valor   = $cadastro->getValor();
      $quantidade = $cadastro->getQuantidade();
      $stmt->bind_param('sisdi', $nome, $id, $descricao, $valor, $quantidade);
      $ret = $stmt->execute();
      $stmt->close();
    }
    return $ret;
  }

  
  public function todos(): array {
    $sql = "SELECT id, nome, descricao, valor, quantidade from cadastros";
    $stmt = $this->connection->prepare($sql);
    $cadastros = [];
    if ($stmt) {
      if ($stmt->execute()) {
        $id = 0; $nome = ''; $descricao=''; $valor=0.0; $quantidade=0;
        $stmt->bind_result($id, $nome, $descricao, $valor, $quantidade);
        $stmt->store_result();
        while($stmt->fetch()) {
          $cadastros[] = new cadastro($id, $nome, $descricao, $valor, $quantidade);
        }
      }
      $stmt->close();
    }
    return $cadastros;
  }

};
