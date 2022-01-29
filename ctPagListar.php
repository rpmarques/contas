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
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Opções</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
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
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Buscar por Fornecedor</label>
                                            <?= $objFornecedores->montaSelect('fornecedor_id'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="form-group">
                  <label>Date range:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservation">
                  </div>
                  <!-- /.input group -->
                </div>
                                    </div>
                                    <!-- <div class="col-md-2">                                    
                                        <div class="form-group">
                                            <label>Data Inicial</label>
                                            <input type="text" class="form-control form-control-sm data" name="datain">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Data Final</label>
                                            <input type="text" class="form-control form-control-sm data" name="datafi">
                                        </div>
                                    </div> -->
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
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
                                        if (isset($_GET['todas']) || isset($_GET['abertas']) || isset($_GET['pagas']) || ($_GET['fornecedor_id']) <> "" || $_GET['datain'] <> "") {
                                            $todas = isset($_GET['todas']);
                                            $abertas = isset($_GET['abertas']);
                                            $pagas = isset($_GET['pagas']);
                                            $fornecedorID = $_GET['fornecedor_id'] <> "" ? $_GET['fornecedor_id'] : "";
                                            $datain = $_GET['datain'] <> "" ? $_GET['datain'] : "";
                                            $datafi = $_GET['datafi'] <> "" ? $_GET['datafi'] : "";
                                            
                                            echo '<pre>';
                                            var_dump($todas);
                                            var_dump($abertas);
                                            var_dump($pagas );
                                            var_dump($fornecedorID );
                                            var_dump($datain );
                                            var_dump($datafi );
                                            //MONTAR O WHERE
                                            $where="";
                                            if ($todas){
                                                $where .="";
                                            }
                                            if ($abertas){
                                                if($where<>""){
                                                    $where .=" AND pago=FALSE ";
                                                }else{
                                                    $where .="  pago=FALSE ";
                                                }                                                
                                            }
                                            if ($pagas){
                                                if($where<>""){
                                                    $where .=" and pago=TRUE ";
                                                }else{
                                                    $where .="  pago=TRUE ";
                                                }                                                
                                            }
                                            if ($fornecedorID){
                                                if($where<>""){
                                                    $where .=" and fornecedor_id=$fornecedorID ";
                                                }else{
                                                    $where .="  fornecedor_id=$fornecedorID ";
                                                }                                                
                                            }
                                            // VALIDAÇÃO DO PERÍDO, DATA INICIAL NÃO PODE SER MAIRO QUE DATA FINAL
                                            escreve($where);
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
                                                <?php
                                                if ($ctp->pago <> '1') { ?>
                                                    <a class="btn bg-gradient-primary btn-xs" href="./clienteEditar.php?id=<?= base64_encode($ctp->id) ?>"><i class="fa fa-edit"></i> Quitar </a>
                                                <?php }
                                                ?>

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