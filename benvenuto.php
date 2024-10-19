
<!DOCTYPE html>
<html>
<head>
    <title> Benvenuto </title>
</head>
<body>

<style> </style>

<h1 style="text-align:center;font-size:300%;">Benvenuto</h1>



<?php

require_once('connessione.php');


if (isset($_GET['username'])) { // controlla se usernname é stato inserito
$username = htmlspecialchars($_GET['username']);
echo "<h2 style='text-align:center;'>$username</h2>";
} else {
echo "<h2 style='text-align:center;'>Dati non forniti.</h2>";
}
?>


</body>
</html>