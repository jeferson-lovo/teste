<?php
error_reporting(E_ALL & ~E_NOTICE);
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
$cadastros = $daoCadastro->todos();

ob_start();

?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro de genericos</h2>
        </div>
        <div class="row mb-2">
            <div class="col-md-12" >
                <a href="novo.php" class="btn btn-primary active" role="button" aria-pressed="true">Cadastros</a>
            </div>
        </div>

<?php 
    if (count($cadastros) >0) 
    {
?>
        <div class="row">
            <div class="col-md-12" >

                <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descricao</th>
                        <th scope="col">Cidade_fab</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
<?php 
        foreach($cadastros as $c) {
?>                    
                    <tr>
                        <th scope="row"><?php echo  $c->getId(); ?></th>
                        <td><?php echo $c->getNome(); ?></td>
                        <td><?php echo $c->getDescricao(); ?></td>
                        <td><?php echo $c->getCidade_fab(); ?></td>
                        <td><?php echo $c->getValor(); ?></td>
                        <td><?php echo $c->getQuantidade(); ?></td>

                        <td>
                            <a class="btn btn-danger btn-sm active" 
                                href="apagar.php?id=<?php echo $c->getId();?>">
                                Apagar
                            </a>
                            <a class="btn btn-secondary btn-sm active" 
                                href="editar.php?id=<?php echo $c->getId();?>">
                                Editar
                            </a>                        
                        </td>
                    </tr>
<?php
        } // foreach
?>                    
                </tbody>
                </table>

            </div>
        </div>
<?php 
    
    }  // if 
?>        
    </div>
<?php

$content = ob_get_clean();
echo html( $content );
    
?>


