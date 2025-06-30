<?php
include "conexao.php";
include "protect.php";

$usuario_id = $_SESSION["id"];

//Consultar dados do contracheque
$sql = "SELECT funcao, salario, descontos, beneficios, data_referencia FROM contracheque WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contracheque</title>
  <link rel="shortcut icon" href="css/favicon-16x16.png" type="image/x-icon">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('css/Fundo.png') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 10px;
      box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 12px;
      max-width: 800px;
      width: 100%;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    th,
    td {
      padding: 10px;
      border: 1px solid #ccc;
    }

    th {
      background-color: #007bff;
    }

    td {
      background-color: #fff;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      color: #2d89ef;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Meu contracheque</h1>
    <?php if ($result->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Nome do usuário</th>
            <th>Data de Referência</th>
            <th>Função</th>
            <th>Salário</th>
            <th>Descontos</th>
            <th>Benefícios</th>
            <th>Salário Líquido</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()):
            $salario_liquido = $row['salario'] - $row['descontos'] + $row['beneficios'];

            // Força a data para o primeiro dia do próximo mês
            $data = new DateTime($row['data_referencia']);
            $data->modify('first day of next month');
            $data_formatada = $data->format('d/m/Y');
          ?>
            <tr>
              <td><?php echo htmlspecialchars($_SESSION['nome']); ?></td>
              <td><?php echo $data_formatada; ?></td>
              <td><?php echo htmlspecialchars($row['funcao']); ?></td>
              <td><?php echo number_format($row['salario'], 2, ',', '.'); ?></td>
              <td><?php echo number_format($row['descontos'], 2, ',', '.'); ?></td>
              <td><?php echo number_format($row['beneficios'], 2, ',', '.'); ?></td>
              <td><?php echo number_format($salario_liquido, 2, ',', '.'); ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>Nenhum contracheque encontrado.</p>
    <?php endif; ?>
    <div style="text-align: center; margin-top: 20px;">
      <a href="painel.php">← Voltar ao painel</a>
    </div>
  </div>

</body>

</html>