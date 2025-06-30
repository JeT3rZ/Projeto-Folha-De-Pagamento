<?php
session_start();
include('conexao.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['cpf'])) {
        echo "Preencha seu CPF";
    } elseif (empty($_POST['senha'])) {
        echo "Preencha sua senha";
    } else {
        $cpf = $conn->real_escape_string($_POST['cpf']);
        $senha = $_POST['senha'];

        // Consultar dados
        $sql = "SELECT id, nome, tipo, cpf ,senha FROM usuarios WHERE cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            // Verificar a senha 
            if (password_verify($senha, $usuario['senha'])) {
                session_start();
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['tipo'] = $usuario['tipo'];
                $_SESSION['cpf'] = $usuario['cpf'];

                header("Location: painel.php");
                exit;
            } else {
                echo "<script> alert('Senha incorreta!');</script>";
            }
        } else {
            echo "<script> alert('CPF Incorreto ou Não Encontrado');</script>";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Estilo.css">
    <title>Area de Login - CP</title>
    <link rel="shortcut icon" href="css/favicon-16x16.png" type="image/x-icon">
    <style>
        button {
      background-color: #2d89ef;
      color: white;
      border: none;
      padding: 12px 20px;
      margin: 10px 0;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
    }

    button:hover {
      background-color: #1b64c3;
    }
    </style>
</head>

<body>

    <main class="container">

        <div>
            <form action="" method="post">


                <H1>Acesso a Folha de pagamento</H1>

                <div class="box">
                    <input type="text" name="cpf" placeholder="CPF">
                </div>


                <div class="box">
                    <input type="password" name="senha" placeholder="Senha">
                </div>


                <button type="submit" class="Login">Login</button>

            </form>
        </div>

    </main>

</body>

</html>