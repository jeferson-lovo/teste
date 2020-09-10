<?php

require_once(__DIR__ . '/../../templates/template-html.php');
require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../model/Cadastro.php');
require_once(__DIR__ . '/../../dao/DaoCadastro.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (! $conn->connect()) {
    die();
}

$daoCadastro = new DaoCadastro($conn);
$cadastro = $daoCadastro->porId( $_POST['id'] );
    
if ( $cadastro )
{  
  $cadastro->setNome( $_POST['nome'] );
  $cadastro->setDescricao( $_POST['descricao'] );
  $cadastro->setValor( $_POST['valor'] );
  $cadastro->setQuantidade( $_POST['quantidade'] );
  $daoCadastro->atualizar( $cadastro );
}

header('Location: ./index.php');