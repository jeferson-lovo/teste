<?php 

class Cadastro {

  private $id;
  private $nome;
  private $descricao;
  private $valor;
  private $quantidade;


  public function __construct(string $nome='', int $id=-1, $descricao='', $valor=0.0, $quantidade=0) {
      $this->id = $id;
      $this->nome = $nome;
      $this->descricao = $descricao;
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

  public function getDescricao(){
    return $this->descricao;
   }

   public function setValor(double $valor) {
    $this->valor = $valor;
   }

   public function getValor(){
       $this->valor;
   }

   public function setQuantidade(int $quantidade) {
    $this->quantidade = $quantidade;
    }

    public function getQuantidade(int $quantidade){
        $this->quantidade;
    }
  
};