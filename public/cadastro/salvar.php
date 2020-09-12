<?php

require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../model/Cadastro.php');
require_once(__DIR__ . '/../../dao/DaoCadastro.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (! $conn->connect()) {
    die();
}

$daoCadastro = new DaoCadastro($conn);
$daoCadastro->inserir( new Cadastro($_POST['nome'], $_POST['descricao'], $_POST['cidade_fab'], $_POST['valor'], $_POST['quantidade']));
    
header('Location: ./index.php');

?>


