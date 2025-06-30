<?php

include "protect.php";
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    echo "Acesso negado. Apenas administradores podem cadastrar usuários.";
    exit();
}
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];
    $hashed_senha = password_hash($senha, PASSWORD_DEFAULT); #deixa a senha segura

    $verificaSql = "SELECT cpf FROM usuarios WHERE cpf = ?";
    $verificaStmt = $conn->prepare($verificaSql);
    $verificaStmt->bind_param("s", $cpf);
    $verificaStmt->execute();
    $verificaResult = $verificaStmt->get_result();
    if ($verificaResult->num_rows > 0) {
        echo "<script>alert('Esse CPF Ja está Cadastrado.'); window.location.href = 'Cadastro.php';</script>";
        exit();
    }
    $sql = "INSERT INTO usuarios (nome,cpf,senha,tipo)VALUES (?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $cpf, $hashed_senha, $tipo);

    if ($stmt->execute()) {
        $novo_usuario_id = $conn->insert_id;
        header("Location: contracheque_form.php?usuario_id=$novo_usuario_id");
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\Estilo.css">
    <link rel="shortcut icon" href="css/favicon-16x16.png" type="image/x-icon">
    <title>Cadastro</title>
    </style>

</head>

<body>
    <main class="container">

        <div>
            <form action="" method="POST">


                <H1>Cadastrar</H1>

                <div class="box">
                    <input type="text" name="nome" placeholder="Nome Completo" required>
                </div>


                <div class="box">
                    <input type="text" name="cpf" placeholder="CPF" required>
                </div>


                <div class="box">
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>

                <div class="box">
                    <label for="tipoUsuario" style="font-size: 13px; color: #777;">Tipo de Usuário</label>
                    <select name="tipo" required>
                        <option value="comum">Comum</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>


                <button type="submit" class="Login">Enviar</button>


            </form>
        </div>

    </main>
</body>

</html>