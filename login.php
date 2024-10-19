<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script>
        window.onload = function() {
            var errorElement = document.getElementById("error-message");
            if (errorElement) {
                setTimeout(function() {
                    errorElement.style.display = "none";
                }, 3000);
            }
        };
    </script>
</head>
<body>

<h1 style="text-align: center;font-size:300%;">Accedi</h1>

<?php
require_once('connessione.php'); // Connessione al database

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo "<h3 id='error-message' style='color:#fb0303; text-align:center;'>Dati non validi</h3>";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Cerchiamo l'utente nel database
        $query = "SELECT * FROM utenti WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Password corretta, reindirizza alla pagina benvenuto.php
            $username = urlencode($username);
            header("Location: benvenuto.php?username=$username");
            exit();
        } else {
            echo "<h3 id='error-message' style='color:#fb0303; text-align:center;'>username o password errati</h3>";
        }
    }
}
?>

<table align="center">
    <tr>
        <td>
            <!-- Form di Login -->
            <form method="POST" action="" style="display:inline;">
                <b><label for="username">Username:</label></b><br>
                <input type="text" id="username" name="username"><br><br>

                <b><label for="password">Password:</label></b><br>
                <input type="password" id="password" name="password"><br><br>

                <input type="submit" name="login" value="ACCEDI">&nbsp;&nbsp;
            </form>


            <form method="GET" action="registrati.php" style="display:inline;">
                <input type="submit" value="REGISTRATI">
            </form>
        </td>
    </tr>
</table>

</body>
</html>
