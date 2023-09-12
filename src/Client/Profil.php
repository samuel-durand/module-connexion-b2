<?php
session_start();

require_once('Class/User.php');

$userCrud = new UserCrud($db);

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $user = $userCrud->getUserById($userId);

        
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim(htmlspecialchars($_POST['login']));
    $firstname = trim(htmlspecialchars($_POST['firstname']));
    $lastname = trim(htmlspecialchars($_POST['lastname']));
    $password = trim(htmlspecialchars($_POST['password']));
    $user = $userCrud->updateUser($id, $login, $firstname, $lastname, $password);

    if ($user) {
       //header("Location: login.php?user_id=" . $user->id);
        exit;
    } else {
        echo 'Une erreur s\'est produite lors de l\'inscription.';
    }


}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
</head>
<body>
    <h1><?php echo "Bienvenue, " . $user->firstname . " " . $user->lastname; ?></h1>


    <form action="" method="post">

    <label for="login">Your login :</label>
    <input type="text" placeholder="">

    <label for="firstname">Your First Name :</label>
    <input type="text" placeholder="">

    <label for="lastname">Your Last Name :</label>
    <input type="text" placeholder="">

    <label for="password">Password : </label>
    <input type="text" placeholder="********">

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
