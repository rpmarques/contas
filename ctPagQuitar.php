<?php
require_once './header.php';
if ($_GET && isset($_GET['id'])) {
  $id = base64_decode($_GET['id']);
  $ctpag = $objContasPagar->pegaConta($id);
  $fornec = $objFornecedores->pegaFornec($ctpag->fornecedor_id);
}
if ($_POST) {
  if (isset($_POST['valor'])) {
    $nronf = $_POST['nronf'];
    $serie = $_POST['serie'];
    $datac = $_POST['datac'];
    $fornecedorID = $_POST['fornecedor_id'];
    $valor = $_POST['valor'];
    $historico = $_POST['historico'];
    $ordem = '1';
    if ($_POST['ordem'] <> '') {
      $ordem = $_POST['ordem'];
    }
    if (($_POST['data_venc']) <> '') {
      $dataVenc = $_POST['data_venc'];
    } else {
      $dataVenc = date('d/m/Y');
    }
    $ret = $objContasPagar->incluirConta($nronf, $serie, $datac, $fornecedorID, $valor, $historico, $ordem, $dataVenc);
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
              require_once './alertaErro.php';
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
              <input type="hidden" name="id" value="<?= $ctpag->id ?>">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Nro NF</label>
                      <input type="text" class="form-control form-control-sm" disabled name="nronf" value="<?= $ctpag->nronf ?>">
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label>Série</label>
                      <input type="text" class="form-control form-control-sm " disabled name="serie" value="<?= $ctpag->serie ?>">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Data</label>
                      <input type="text" class="form-control form-control-sm data" disabled name="datac" value="<?= formataData($ctpag->datac) ?>">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Data Venc.</label>
                      <input type="text" class="form-control form-control-sm data" disabled name="data_venc" value="<?= formataData($ctpag->data_venc) ?>">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Fornecedor</label>
                      <input class="form-control form-control-sm" type="text" disabled value="<?= $ctpag->fornecedor_id . " - " . $fornec->nome; ?>">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Valor da Parcela</label>
                      <input class="form-control form-control-sm valor" name="valor" disabled value="<?= $ctpag->valor ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label>Parcela</label>
                      <input class="form-control form-control-sm " type="text" name="ordem" disabled value="<?= $ctpag->ordem . "/" . $ctpag->total_ordem ?>">
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <label>Histórico</label>
                      <input class="form-control form-control-sm " name="historico" disabled type="text" value="<?= $ctpag->historico ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Forma de Pgto</label>
                      <?= $objContasPagar->montaSelect('forma_pgto_id'); ?>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Data Pgto.</label>
                      <input type="text" class="form-control form-control-sm data" name="data_venc" value="<?php echo date('d/m/Y')?>" >
                    </div>
                  </div>
                </div>
              </div> <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Quitar</button>
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