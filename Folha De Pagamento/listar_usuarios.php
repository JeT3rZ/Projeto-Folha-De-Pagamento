<?php
include "conexao.php";
include "protect.php";

// Consulta todos os usuários com suas funções
$sql = "SELECT u.id, u.nome, u.cpf, u.tipo, c.funcao, c.data_referencia
        FROM usuarios u
        LEFT JOIN contracheque c ON u.id = c.usuario_id
        ORDER BY u.id ASC";

$result = $conn->query($sql);

if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

// Separa os usuários por tipo
$admins = [];
$comuns = [];

while ($usuario = $result->fetch_assoc()) {
    if ($usuario['tipo'] === 'admin') {
        $admins[] = $usuario;
    } else {
        $comuns[] = $usuario;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="css/favicon-16x16.png" type="image/x-icon">
    <title>Gerenciamento de Usuários</title>
</head>
<script>
    function mudarpag() {
        location.href = "painel.php";
    }
</script>

<body>

    <h1>Gerenciamento de Usuários</h1>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('css/Fundo.png') no-repeat center center fixed;
            background-size: cover;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h1,
        h2 {
            text-align: center;
            color: #333;
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #555;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

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
            width: 100%;
            max-width: 200px;
        }

        button:hover {
            background-color: #1b64c3;
        }

        .voltar {
            display: block;
            text-align: center;
            margin: 30px auto;
            font-size: 16px;
            color: #007bff;
        }

        a {
            display: inline;
            margin: 8px 0;
            color: #2d89ef;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <p>Bem-vindo, <?php echo $_SESSION['nome']; ?> </p>

    <h2>Administradores</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Função</th>
            <th>Data de entrada</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($admins as $admin): ?>
            <tr>
                <td><?php echo $admin['id']; ?></td>
                <td><?php echo $admin['nome']; ?></td>
                <td><?php echo $admin['cpf']; ?></td>
                <td><?php echo $admin['funcao']; ?></td>
                <td><?php echo $admin['data_referencia']; ?></td>
                <td>
                    <?php if ($admin['id'] == 1 && $_SESSION['id'] != 1): ?>
                        Editar |
                    <?php else: ?>
                        <a href="editar_usuario.php?id=<?php echo $admin['id']; ?>">Editar</a> |
                    <?php endif; ?>

                    <a href="excluir_usuario.php?id=<?php echo $admin['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')"> Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Usuários Comuns</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Função</th>
            <th>Data de entrada</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($comuns as $comum): ?>
            <tr>
                <td><?php echo $comum['id']; ?></td>
                <td><?php echo $comum['nome']; ?></td>
                <td><?php echo $comum['cpf']; ?></td>
                <td><?php echo $comum['funcao']; ?></td>
                <td><?php echo $comum['data_referencia']; ?></td>
                <td>
                    <a href="editar_usuario.php?id=<?php echo $comum['id']; ?>">Editar</a> |
                    <a href="excluir_usuario.php?id=<?php echo $comum['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <div style="text-align: center; margin-top: 20px;">
        <button onclick="mudarpag()">Voltar</button>
    </div>
</body>

</html>