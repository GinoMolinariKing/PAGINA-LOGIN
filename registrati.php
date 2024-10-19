<!DOCTYPE html>
<html>
<head>
    <title>Registrazione</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 1vh;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        .show-password-btn {
            margin-left: 10px;
            cursor: pointer;
        }
    </style>
    <script>
        function togglePasswordVisibility(id) {
            var field = document.getElementById(id);
            var icon = document.getElementById(id + "-toggle");
            if (field.type === "password") {
                field.type = "text";
                icon.innerHTML = "Nascondi";
            } else {
                field.type = "password";
                icon.innerHTML = "Mostra";
            }
        }
    </script>
</head>
<body>

<h1 style="text-align:center;font-size:300%;">Registrazione</h1>
<h2 style="text-align: center;font-size:300%;">Inserisci i tuoi dati</h2>

<?php
require_once('connessione.php'); // Connessione al database

$passwordError = "";
$username = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperiamo i dati dal form
    $username = $_POST["username"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confermaPass"];

    // Controlliamo se le password coincidono
    if ($password !== $confirmPassword) {
        $passwordError = "Le password non coincidono!";
    } else {
        // Criptiamo la password prima di salvarla nel database
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Inseriamo i dati nel database
        $query = "INSERT INTO utenti (username, nome, cognome, password) VALUES (:username, :nome, :cognome, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cognome', $cognome);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {

            header("Location: benvenuto.php?username=" . urlencode($username));
            exit();
        } else {
            echo "Errore durante la registrazione. Riprova.";
        }
    }
}
?>

<table align="center">
    <tr>
        <td>
            <form method="POST" action="" style="display:inline;">
                <b><label for="username">Username:</label></b> <br>
                <input type="text" id="username" name="username" required><br><br>

                <b><label for="nome">Nome:</label></b> <br>
                <input type="text" id="Nome" name="nome" required><br><br>

                <b><label for="cognome">Cognome:</label></b> <br>
                <input type="text" id="cognome" name="cognome" required><br><br>

                <b><label for="password">Password:</label></b> <br>
                <input type="password" id="password" name="password" required>
                <span id="password-toggle" class="show-password-btn" onclick="togglePasswordVisibility('password')">Mostra</span><br><br>

                <b><label for="confermaPass">Conferma Password:</label></b> <br>
                <input type="password" id="confermaPass" name="confermaPass" required>
                <span id="confermaPass-toggle" class="show-password-btn" onclick="togglePasswordVisibility('confermaPass')">Mostra</span><br>


                <?php if ($passwordError): ?>
                    <span class="error-message"><strong><?= $passwordError ?></strong></span><br>
                <?php endif; ?>

                <br>
                <div class="container">
                    <input type="submit" value="REGISTRATI">
                </div>
            </form>
        </td>
    </tr>
</table>

</body>
</html>