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
$cadastro= $daoCadastro->porId( $_GET['id'] );
    
if (! $cadastro)
    header('Location: ./index.php');

else {  
    ob_start();

?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro de produtos genericos</h2>
        </div>
        <div class="row">
            <div class="col-md-12" >

              <form action="atualizar.php" class="card p-2 my-4" method="POST">
                  <div class="input-group">
                      <input type="hidden" name="id" 
                          value="<?php echo $cadastro->getId(); ?>">                      

                          <input type="text" placeholder="Nome " 
                          value="<?php echo $cadastro->getNome(); ?>"
                          class="form-control" name="nome" required>

                        <input type="text" placeholder="Descricao" 
                        value="<?php echo $cadastro->getDescricao(); ?>"
                            class="form-control" name="descricao" required>
                
                        <input type="text" placeholder="Cidade_fab" 
                        value="<?php echo $cadastro->getCidade_fab(); ?>"
                            class="form-control" name="cidade_fab" required>
                
                        <input type="number" placeholder="Valor" 
                        value="<?php echo $cadastro->getValor(); ?>"
                            class="form-control" name="valor" required>
                    
                        <input type="number" placeholder="Quantidade" 
                        value="<?php echo $cadastro->getQuantidade(); ?>"
                            class="form-control" name="quantidade" required>


                      <div class="input-group-append">
                          <button type="submit" class="btn btn-primary">
                              Salvar
                          </button>
                      </div>
                  </div>
              </form>
              <a href="index.php" class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>

            </div>
        </div>
    </div>
<?php

    $content = ob_get_clean();
    echo html( $content );
} // else-if

?>
