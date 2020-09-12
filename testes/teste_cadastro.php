<?php

require_once('../db/Db.php');
require_once('../model/Cadastro.php');
require_once('../dao/DaoCadastro.php');

function DaoCad_testar_inserir(DaoCadastro $dao, Cadastro $cad): bool {
  echo "Testando 'inserir'... ";
  $ret = $dao->inserir($cad);
  echo ($ret) ? "Ok <br>\n" : "Erro <br>\n";
  return $ret;
}

function DaoCad_testar_porId(DaoCadastro $dao, Cadastro $cad): bool {
  echo "Testando 'porId()'... ";
  $id = $cad->getId();
  $cadById = $dao->porId($id);
  $ret =  (!is_null($cadById)) && 
          $cadById->getId() == $cad->getId() &&
          $cadById->getNome() == $cad->getNome() && 
          $cadById->getDescricao() == $cad->getDescricao() &&
          $cadById->getCidade_fab() == $cad->getCidade_fab() &&
          $cadById->getValor() == $cad->getValor() &&
          $cadById->getQuantidade() == $cad->getQuantidade() &&;
  echo ($ret) ? "Ok <br>\n" : "Erro <br>\n";
  return $ret;

}

function DaoCad_testar_todos(DaoCadastro $dao, Cadastro $cad): bool {
  echo "Testando 'todos()'... ";
  $ret = false;
  $cads = $dao->todos();
  if (is_array($cads) && count($cads)>0 ) {
    foreach($cads as $c) {
      $ret =  $c->getId() == $cad->getId() &&
              $c->getNome() == $cad->getNome()
              $c->getDescricao() == $cad->getDescricao()
              $c->getCidade_fab() == $cad->getCidade_fab()
              $c->getValor() == $cad->getValor()
              $c->getQuantidade() == $cad->getQuantidade();
      if ($ret) break;
    }
  }
  echo ($ret) ? "Ok <br>\n" : "Erro <br>\n";
  return $ret;
}

function DaoCad_testar_atualizar(DaoCadastro $dao, Cadastro $cad): bool {
  echo "Testando 'atualizar()'... ";
  $ret = false;
  $novoNome = $cad->getNome() . '[modificado]';
  $cad->setNome( $novoNome );
  if ( $dao->atualizar($dep) ) {
    $cadAtualizado = $dao->porId( $cad->getId() );
    $ret = $cadAtualizado->getNome() === $novoNome;
  }
  echo ($ret) ? "Ok <br>\n" : "Erro <br>\n";
  return $ret;
}

function DaoCad_testar_remover(DaoCadastro $dao, Cadastro $cad): bool {
  echo "Testando 'remover()'... ";
  $ret = false;
  if ( $dao->remover($cad) ) {
    $cadRemovido = $dao->porId( $cad->getId() );
    $ret = is_null($cadRemovido);
  }
  echo ($ret) ? "Ok <br>\n" : "Erro <br>\n";
  return $ret;
}




function testar_DaoCadastro(): bool {
  echo "<h2>Testando DaoCadastro</h2>\n"; 

  $db = new Db("localhost", "user", "user", "vendas");

  if ($db->connect()) {
    $daoCad= new DaoCadastro($db);
    $Cad = new Cadastro("cadastro teste");

    DaoCad_testar_inserir($daoCad, $cad);
    DaoCad_testar_porId($daoCad, $cad);
    DaoCad_testar_todos($daoCad, $cad);
    DaoCad_testar_atualizar($daoCad, $cad);
    DaoCad_testar_remover($daoCad, $cad);

    return true;
  }
  else {
    echo "<p>Erro na conexão com o banco de dados.</p>\n";
    return false;
  }    
}

// testar_DaoCadastro();