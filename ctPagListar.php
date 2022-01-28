<?php
require_once './header.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Listagem de Contas à Pagar</h3><br>
                            <form action="./ctPagListar.php" method="get">
                                <div class="form-group">
                                    <label>Opções</label>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="todas" value="1">
                                        <label for="customCheckbox1" class="custom-control-label">Trazer todos</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="abertas" value="1">
                                        <label for="customCheckbox2" class="custom-control-label">Somente em Aberto</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox3" name="pagas" value="1">
                                        <label for="customCheckbox3" class="custom-control-label">Somente Pagas</label>
                                    </div>
                                </div>
                                <button type="submit">Filtrar</button>
                            </form>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>NroNF</th>
                                        <th>Série</th>
                                        <th>Data</th>
                                        <th>Valor</th>
                                        <th>Data Venc</th>
                                        <th>Situação</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($_GET) {
                                        if (isset($_GET['todas']) || isset($_GET['abertas']) || isset($_GET['pagas'])) {
                                            escreve("tem get");
                                            $todas = isset($_GET['todas']);
                                            $abertas = isset($_GET['abertas']);
                                            $pagas = isset($_GET['pagas']);
                                        }
                                    }
                                    $ctpag = $objContasPagar->select();
                                    foreach ($ctpag as $ctp) { ?>
                                        <tr>
                                            <td><?= $ctp->nronf; ?></td>
                                            <td><?= $ctp->serie; ?></td>
                                            <td><?= formataData($ctp->datac); ?></td>
                                            <td><?= formataMoeda($ctp->valor); ?></td>
                                            <td><?= formataData($ctp->data_venc); ?></td>
                                            <td><?= $ctp->pago == '1' ? 'PAGO' : 'EM ABERTO'; ?></td>
                                            <td>
                                                <a class="btn bg-gradient-primary btn-xs" href="./clienteEditar.php?id=<?= base64_encode($ctp->id) ?>"><i class="fa fa-edit"></i> Quitar </a>
                                                <a class="btn bg-gradient-danger btn-xs" href="./clienteExcluir.php?id=<?= base64_encode($ctp->id) ?>"><i class="fa fa-eraser"></i> Exluir </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div> <!-- /.content-wrapper -->
<?php require_once './footer.php'; ?>