<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { // Remove o ponto e vírgula errado
    $cpf = $_POST['cpf'];

    $conn = mysqli_connect('localhost', 'root', '', 'teste');
    if (mysqli_connect_errno()) {
        echo "Falhou MYSQL: " . mysqli_connect_error();
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM pessoa WHERE cpf = ?");
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<br> CPF[" . htmlspecialchars($row["cpf"]) . "] Nome [" . htmlspecialchars($row["nome"]) . "]";
    } else {
        echo "CPF não encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="form_login.php" method="POST">
        CPF <input type="text" size="20" name="cpf"> <br>
        <input type="submit" value="Pesquisar">
    </form>
</body>

</html>