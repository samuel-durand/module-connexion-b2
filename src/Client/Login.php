<?php
require_once('Class/User.php');

session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $login = $_POST['login'];
    $password = $_POST['password'];

    $user = $userCrud->loginUser($login, $password);

    if ($user) {
        // Rediriger l'utilisateur vers la page profil.php après la connexion réussie
        header("Location: Profil.php");
        exit;
    } else {
        echo 'Échec de la connexion. Veuillez vérifier vos identifiants.';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>

<h2>Connexion</h2>

<form  method="POST">
    <label for="login">Login :</label>
    <input type="text" id="login" name="login" required><br><br>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" placeholder="********" required><br><br>

    <input type="submit" value="Se connecter">
</form>

</body>
</html>