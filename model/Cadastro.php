<?php 

class Cadastro {

  private $id;
  private $nome;
  private $descricao;
  private $cidade_fab;
  private $valor;
  private $quantidade;

  public function __construct(string $nome='', string $descricao='', string $cidade_fab='', float $valor=0.0, int $quantidade=0, int $id=-1) {
      $this->id = $id;
      $this->nome = $nome;
      $this->descricao = $descricao;
      $this->cidade_fab = $cidade_fab;
      $this->valor = $valor;
      $this->quantidade = $quantidade; 
  }

  public function setId(int $id) {
      $this->id = $id;
  }

  public function getId() {
      return $this->id;
  }

  public function setNome(string $nome) {
      $this->nome = $nome;
  }

  public function getNome() {
      return $this->nome;
  }

  public function setDescricao(string $descricao) {
      $this->descricao = $descricao;
  }

  public function getDescricao() {
      return $this->descricao;
  }

  public function setCidade_fab(string $cidade_fab) {
      $this->cidade_fab = $cidade_fab;
}

 public function getCidade_fab() {
     return $this->cidade_fab;
}

 public function setValor(float $valor) {
    $this->valor = $valor;
}

 public function getValor() {
    return $this->valor;
}

 public function setQuantidade(int $quantidade)  {
     $this->quantidade = $quantidade;
}
    
 public function getQuantidade() {
    return $this->quantidade;
}   



};