<?php
include "conexao.php";
include "protect.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (!isset($_GET['usuario_id'])) {
        echo "Erro: ID do usuário não informado na URL.";
        exit;
    }
    $usuario_id = $_GET['usuario_id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['usuario_id'])) {
        echo "<script>alert('Erro: ID do usuário não informado.'); window.history.back();</script>";
        exit;
    }

    $usuario_id = $_POST['usuario_id'];
    $salario = $_POST['salario'];
    $descontos = $_POST['descontos'];
    $beneficios = $_POST['beneficios'];
    $data_referencia = $_POST['data_referencia'];
    $funcao = $_POST['funcao'];

    // Evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO contracheque (usuario_id, funcao, salario, descontos, beneficios, data_referencia) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isddss", $usuario_id, $funcao, $salario, $descontos, $beneficios, $data_referencia);

    if ($stmt->execute()) {
        echo "<script>
            alert('Contracheque cadastrado com sucesso!');
            window.location.href = 'painel.php';
        </script>";
        exit;
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
        exit;
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\Estilo.css">
    <title>Cadastro de Contracheque</title>
</head>

<body>
    <main class="container">
        <div>
            <h2>Cadastro de Contracheque</h2>
            <form action="contracheque_form.php" method="post">
                <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
                <div class="box">
                    <input type="text" name="funcao" placeholder="Função" required><br><br>
                </div>

                <div class="box">
                    <input type="number" name="salario" placeholder="Salario" required><br><br>
                </div>

                <div class="box">
                    <input type="number" name="descontos" placeholder="Descontos"><br><br>
                </div>

                <div class="box">
                    <input type="number" name="beneficios" placeholder="Beneficios"><br><br>
                </div>

                <div class="box">
                    <input type="date" name="data_referencia" required><br><br>
                </div>
                <button type="submit" class="Login">Salvar Contracheque</button>
        </div>

        </form>
    </main>
</body>

</html>