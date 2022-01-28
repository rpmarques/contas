<?php

class CtPag
{
    // Atributo para conexão com o banco de dados   
    private $pdo = null;
    // Atributo estático para instância da própria classe    
    private static $ctpgag = null;
    private function __construct($conexao)
    {
        $this->pdo = $conexao;
    }
    public static function getInstance($conexao)
    {
        if (!isset(self::$ctpgag)) :
            self::$ctpgag = new CtPag($conexao);
        endif;
        return self::$ctpgag;
    }
    //public function incluirConta($rNronf,$rSerie,$rDatac,$rFornecedorID,$rValor,$rHistorico,$rOrdem,$rDataVenc){
    public function incluirConta($rDatac,$rOrdem,$rDataVenc)
    {
        try {
            $auxDataVenc=$rDataVenc;
            if ($rOrdem > 1) {
                //LOOP NO NRO DE PARCELAS
                for ($i = 1; $i <= $rOrdem; $i++) {
                    //CALCULO DA DATA DE VENCIMENTO                    
                    if ($i===1){ //PRIMEIRA PARCELA
                        //$auxDataVenc = $rDataVenc;
                        escreve("PARCELADO -------- PARCELA:[$i], DATAC:[$rDatac], DATA_VENC:[$auxDataVenc]");  
                        //AQUI FAZ UM INSERT  
                    }else{ //DEMAIS PARCELAS
                        escreve("PARCELADO -------- PARCELA:[$i], DATAC:[$rDatac], DATA_VENC:[$auxDataVenc]");
                        //AQUI FAZ UM INSERT
                    }                       
                    //$data = somar_datas( $i, 'm'); // adiciona 3 meses a sua data                 
                    $auxDataVenc = somaMes(1, $auxDataVenc);
                }
            } else {
                escreve(" AVISTA -------- PARCELA:[$rOrdem], DATAC:[$rDatac], DATA_VENC:[$auxDataVenc] ");
                //AQUI FAZ UM INSERT
            }
            return;

            // $rSql = "INSERT INTO ctpag (datac,nronf,fornecedor_id,valor,historico,ordem,data_venc) 
            //                      VALUE (:datac,:nronf,:fornecedor_id,:valor,:historico,:ordem,:data_venc);";
            // $stm = $this->pdo->prepare($rSql);
            // $stm->bindValue(':datac', gravaData($rDatac));
            // $stm->bindValue(':nronf', $rNronf);
            // $stm->bindValue(':fornecedor_id', $rFornecedorID);
            // $stm->bindValue(':valor', gravaMoeda($rValor));
            // $stm->bindValue(':historico', $rHistorico);
            // $stm->bindValue(':ordem', $rOrdem);
            // $stm->bindValue(':data_venc', gravaData($auxDataVenc));

            // $stm->execute();
            // if ($stm) {
            //     Logger('USUARIO:[' . $_SESSION['login'] . '] - INSERIU CTPAG NRONF:[' . $rNronf . '], SERIE:[' . $rSerie . '],PARCELA:[' . $rOrdem . ']');
            // }
            // return $stm;
        } catch (PDOException $erro) {
            Logger('USUARIO:[' . $_SESSION['login'] . '] - ARQUIVO:[' . $erro->getFile() . '] - LINHA:[' . $erro->getLine() . '] - Mensagem:[' . $erro->getMessage() . ']');
        }
    }

    public function delete($rId)
    {
        if (!empty($rId)) :
            try {
                $sql = "DELETE FROM cliente WHERE id=:id";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(':id', $rId);
                $stm->execute();
                if ($stm) {
                    Logger('Usuario:[' . $_SESSION['login'] . '] - EXCLUIU CLIENTE - ID:[' . $rId . ']');
                }
                return $stm;
            } catch (PDOException $erro) {
                Logger('USUARIO:[' . $_SESSION['login'] . '] - ARQUIVO:[' . $erro->getFile() . '] - LINHA:[' . $erro->getLine() . '] - Mensagem:[' . $erro->getMessage() . ']');
            }
        endif;
    }

    public function update($rNome, $rCnpj, $rFone1, $rFone2, $rEmail, $rContato, $rId, $rCpf)
    {
        try {
            $sql = "UPDATE cliente SET nome=:nome,cnpj=:cnpj,fone1=:fone1,fone2=:fone2,email=:email,contato=:contato, 
                     cpf=:cpf WHERE id=:id;";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':nome', $rNome);
            $stm->bindValue(':cnpj', $rCnpj);
            $stm->bindValue(':fone1', $rFone1);
            $stm->bindValue(':fone2', $rFone2);
            $stm->bindValue(':email', strtolower($rEmail));
            $stm->bindValue(':contato', $rContato);
            $stm->bindValue(':id', $rId);
            $stm->bindValue(':cpf', $rCpf);
            $stm->execute();
            if ($stm) {
                Logger('Usuario:[' . $_SESSION['login'] . '] - ALTEROU CLIENTE - ID:[' . $rId . ']');
            }
            return $stm;
        } catch (PDOException $erro) {
            Logger('USUARIO:[' . $_SESSION['login'] . '] - ARQUIVO:[' . $erro->getFile() . '] - LINHA:[' . $erro->getLine() . '] - Mensagem:[' . $erro->getMessage() . '] - SQL:[' . $sql . ']');
        }
    }

    public function selectUM($rWhere)
    {
        try {
            echo $sql = "SELECT * FROM clientes " . $rWhere;
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $dados = $stm->fetch(PDO::FETCH_OBJ);
            return $dados;
        } catch (PDOException $erro) {
            Logger('USUARIO:[' . $_SESSION['login'] . '] - ARQUIVO:[' . $erro->getFile() . '] - LINHA:[' . $erro->getLine() . '] - Mensagem:[' . $erro->getMessage() . '] - SQL:[' . $sql . ']');
        }
    }

    public function pegaCli($rID)
    {
        try {
            $sql = "SELECT * FROM cliente WHERE id=$rID";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $dados = $stm->fetch(PDO::FETCH_OBJ);
            return $dados;
        } catch (PDOException $erro) {
            Logger('USUARIO:[' . $_SESSION['login'] . '] - ARQUIVO:[' . $erro->getFile() . '] - LINHA:[' . $erro->getLine() . '] - Mensagem:[' . $erro->getMessage() . '] - SQL:[' . $sql . ']');
        }
    }

    public function select($rWhere = '')
    {
        try {
            $sql = "SELECT * FROM cliente " . $rWhere;
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $dados = $stm->fetchAll(PDO::FETCH_OBJ);
            return $dados;
        } catch (PDOException $erro) {
            Logger('USUARIO:[' . $_SESSION['login'] . '] - ARQUIVO:[' . $erro->getFile() . '] - LINHA:[' . $erro->getLine() . '] - Mensagem:[' . $erro->getMessage() . ']');
        }
    }

    public function montaSelect($rNome = 'cliente_id', $rSelecionado = null)
    {
        try {
            $objClientes = Clientes::getInstance(Conexao::getInstance());
            $dados = $objClientes->select(" ORDER BY nome");
            $select = '';
            $select = '<select class="select2" name="' . $rNome . '" id="' . $rNome . '" data-placeholder="Selecione um cliente..." style="width: 100%;">'
                . '<option value="">&nbsp;</option>';
            foreach ($dados as $linhaDB) {
                if (!empty($rSelecionado) && $rSelecionado === $linhaDB->id) {
                    $sAdd = 'selected';
                } else {
                    $sAdd = '';
                }
                $select .= '<option value="' . $linhaDB->id . '"' . $sAdd . '>' . $linhaDB->id . ' - ' . $linhaDB->nome . '</option>';
            }
            $select .= '</select>';
            return $select;
        } catch (PDOException $erro) {
            Logger('Usuario:[' . $_SESSION['login'] . '] - Arquivo:' . $erro->getFile() . ' Erro na linha:' . $erro->getLine() . ' - Mensagem:' . $erro->getMessage());
        }
    }
}
