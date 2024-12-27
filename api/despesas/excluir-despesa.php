<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idDespesa = isset($_POST["idDespesa"]) ? $_POST["idDespesa"] : "";

    $conn->beginTransaction();

    try {
        $sqlVerificaFilha = "SELECT IDDESPESAREF 
                             FROM DESPESAS 
                             WHERE IDDESPESA = :idDespesa";

        $stmtVerificaFilha = $conn->prepare($sqlVerificaFilha);
        $stmtVerificaFilha->bindParam(":idDespesa", $idDespesa);
        $stmtVerificaFilha->execute();

        $despesaFilha = $stmtVerificaFilha->fetch(PDO::FETCH_ASSOC);

        if ($despesaFilha["IDDESPESAREF"]) {
            $idDespesaPai = $despesaFilha["IDDESPESAREF"];
            $sqlAtualizaParcelas = "UPDATE DESPESAS SET 
                                    TOTALPARCELAS = TOTALPARCELAS - 1 
                                    WHERE IDDESPESA = :idDespesaPai";

            $stmtAtualizaParcelas = $conn->prepare($sqlAtualizaParcelas);
            $stmtAtualizaParcelas->bindParam(":idDespesaPai", $idDespesaPai);
            $stmtAtualizaParcelas->execute();

            $sqlAtualizaParcelasFilhas = "UPDATE DESPESAS SET 
                                          TOTALPARCELAS = TOTALPARCELAS - 1 
                                          WHERE IDDESPESAREF = :idDespesaPai";

            $stmtAtualizaParcelasFilhas = $conn->prepare($sqlAtualizaParcelasFilhas);
            $stmtAtualizaParcelasFilhas->bindParam(":idDespesaPai", $idDespesaPai);
            $stmtAtualizaParcelasFilhas->execute();

            $sqlFilha = "DELETE FROM DESPESAS 
                         WHERE IDDESPESA = :idDespesa";

            $stmtFilha = $conn->prepare($sqlFilha);
            $stmtFilha->bindParam(":idDespesa", $idDespesa);
            $stmtFilha->execute();
        } else {
            $sqlExcluirFilhas = "DELETE FROM DESPESAS 
                                 WHERE IDDESPESAREF = :idDespesa";

            $stmtExcluirFilhas = $conn->prepare($sqlExcluirFilhas);
            $stmtExcluirFilhas->bindParam(":idDespesa", $idDespesa);
            $stmtExcluirFilhas->execute();

            $sqlExcluirPai = "DELETE FROM DESPESAS 
                              WHERE IDDESPESA = :idDespesa";

            $stmtExcluirPai = $conn->prepare($sqlExcluirPai);
            $stmtExcluirPai->bindParam(":idDespesa", $idDespesa);
            $stmtExcluirPai->execute();
        }

        $conn->commit();

        redirecionar("Despesas", "Despesa excluída com sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        $conn->rollBack();

        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") !== false) {
                redirecionar("Despesas", "Erro ao excluir a Despesa. Ela está relacionada a outros registros.", "red");
            }
        } else {
            redirecionar("Despesas", "Erro ao excluir a Despesa. Erro: $ex", "red");
        }
        exit;
    }
?>
