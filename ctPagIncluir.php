<?php
require_once './header.php';
if ($_POST) {
  if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $fone1 = $_POST['fone1'];
    $fone2 = $_POST['fone2'];
    $email = $_POST['email'];
    $contato = '';
    $cpf = $_POST['cpf'];
    $ret = $objClientes->insert($nome, $cnpj, $fone1, $fone2, $email, $contato, $cpf);
  }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header"> </section> <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <?php
          if (isset($ret)) {
            if ($ret) {
              require_once './alertaSucesso.php';
            } else {
              require_once './alertaErro.php.php';
            }
          }
          ?>
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Inclusão de Conta</h3>
            </div> <!-- /.card-header -->
            <!-- form start -->
            <form method="post">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Nro NF</label>
                      <input type="text" class="form-control form-control-sm" name="nronf">
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label>Série</label>
                      <input type="text" class="form-control form-control-sm " name="serie">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Data</label>
                      <input type="text" class="form-control form-control-sm data" name="datac" value="<?php echo date('d/m/Y') ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Cliente</label>
                      <?=$objClientes->montaSelect('cliente_id');?>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Valor</label>
                      <input class="form-control form-control-sm " name="valor">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Histórico</label>
                      <input class="form-control form-control-sm " name="text" type="text">
                    </div>
                  </div>
                </div>
              </div> <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Gravar</button>
              </div>
            </form>
          </div> <!-- /.card -->
        </div>
        <!--/.col  -->
      </div> <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
<?php require_once './footer.php'; ?>