<?php

require_once(__DIR__ . '/../../templates/template-html.php');

require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../model/cadastro.php');
require_once(__DIR__ . '/../../dao/DaoCadastro.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (! $conn->connect()) {
    die();
}

$daoCadastro = new DaoCadastro($conn);
$cadastro = $daoCadastro->porId( $_GET['id'] );
    
if (! $cadastro )
    header('Location: ./index.php');

else {  
    ob_start();

?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro </h2>
        </div>
        <div class="row">
            <div class="col-md-12" >

              <form action="atualizar.php" class="card p-2 my-4" method="POST">
                  <div class="input-group">
                      <input type="hidden" name="id" 
                          value="<?php echo $cadastro->getId(); ?>">                      
                      <input type="text" placeholder="cadastro" 
                          value="<?php echo $cadastro->getNome(); ?>"
                          class="form-control" name="nome" required>

                      <input type="text" placeholder="cadastro" 
                          value="<?php echo $cadastro->getDescricao(); ?>"
                          class="form-control" name="descricao" required>

                      <input type="number" class="form-control" min="0.00" max="10000.00" 
                          step="0.01"  id="valor" 
                          value="<?php echo $cadastro->getValor(); ?>"
                          name="valor" placeholder="valor" required>

                    <input type="number" placeholder="cadastro" 
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
