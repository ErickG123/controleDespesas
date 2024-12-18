<?php
    function gerarSelect($conn, $tabela, $campoId, $campoDescricao, $nomeInput, $selectedText, $mensagemVazia = "Nenhum registro encontrado.") {
        try {
            $sql = "SELECT $campoId, $campoDescricao FROM $tabela";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                foreach ($result as $row) {
                    echo '<label for="opcao' . $selectedText . $row[$campoId] . '" class="block px-4 py-2 cursor-pointer hover:bg-gray-100">';
                    echo '<input type="radio" id="opcao' . $selectedText . $row[$campoId] . '" name="' . $nomeInput . '[]" value="' . $row[$campoId] . '" class="form-checkbox mr-2" onclick="updateSelectedText(\'' . $selectedText . '\', \'' . $nomeInput . '\');">';
                    echo '<span>' . $row[$campoDescricao] . '</span>';
                    echo '</label>';
                }
            } else {
                echo '<label for="opcaoVazia" class="block px-4 py-2 hover:bg-gray-100">';
                echo '<span>' . $mensagemVazia . '</span>';
                echo '</label>';
            }
        } catch (PDOException $e) {
            $_SESSION["alert_title"] = "Erro ao Gerar o Select";
            $_SESSION["alert_msg"] = "Erro ao conectar ao Banco de Dados: " . $e->getMessage();
            $_SESSION["alert_color"] = "red";

            exit;
        }
    }
?>
