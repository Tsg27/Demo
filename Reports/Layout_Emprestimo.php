<?php
require_once __DIR__ . '/../Config/web-extends.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório</title>
    <link rel="stylesheet" href="../Reports/css/Styles-reports.css">
</head>

<body>
    <h1>School Library - Relatório de Empréstimos</h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Aluno</th>
                    <th>Titulo</th>
                    <th>Subtítulo</th>
                    <th>Empréstimo</th>
                    <th>Devolução</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Verifica se a conexão foi estabelecida
                    if (!isset($pdo)) {
                    throw new Exception('A conexão com o banco de dados não foi estabelecida.');
                    }

                    $sql = "SELECT * FROM emprestimo WHERE StatusEmprestimo IN ('Disponível', 'Emprestado', 'Reservado', 'Manutenção', 'Descontinuado') ORDER BY data_registro DESC";
                    $result = $pdo->query($sql);
                    
                    if ($result->rowCount() > 0) {
                        while ($user_data = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td class='col-lg-2'>" . $user_data['MatriculaAluno'] . "</td>";
                            echo "<td class='col-lg-2'>" . $user_data['NomeAluno'] . "</td>";
                            echo "<td class='col-lg-2'>" . $user_data['TituloLivro'] . "</td>";
                            echo "<td class='col-lg-2'>" . $user_data['SubTituloLivro'] . "</td>";
                            echo "<td class='col-lg-2'>" . $user_data['DataEmprestimo'] . "</td>";
                            echo "<td class='col-lg-1'>" . $user_data['DataDevolucao'] . "</td>";
                            echo "<td class='col-lg-1'>" . $user_data['StatusEmprestimo'] . "</td>";
                          
                        }
                    }
                } catch (PDOException $e) {
                    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>