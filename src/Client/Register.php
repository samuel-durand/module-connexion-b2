<?php
require_once('Class/User.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire tout en appliquant htmlspecialchars et trim
    $login = trim(htmlspecialchars($_POST['login']));
    $firstname = trim(htmlspecialchars($_POST['firstname']));
    $lastname = trim(htmlspecialchars($_POST['lastname']));
    $password = $_POST['password']; // Vous pouvez laisser le mot de passe tel quel, il ne devrait pas être affiché dans la sortie HTML

    $user = $userCrud->createUser($login, $firstname, $lastname, $password);

    if ($user) {
       header("Location: login.php?user_id=" . $user->id);
        exit;
    } else {
        echo 'Une erreur s\'est produite lors de l\'inscription.';
    }


}

?>





<!DOCTYPE html>
<html>
<head>
    <title>Formulaire d'inscription</title>
</head>

<body>

<h2>Inscription</h2>

<form method="POST" id="registrationForm">
    <label for="login">Login :</label>
    <input type="text" id="login" name="login" required><br><br>

    <label for="firstname">Prénom :</label>
    <input type="text" id="firstname" name="firstname" required><br><br>

    <label for="lastname">Nom de famille :</label>
    <input type="text" id="lastname" name="lastname" required><br><br>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="S'inscrire">
</form>

</body>
</html>
