<?php
session_start();

require_once('Class/User.php');

$userCrud = new UserCrud($db);

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $user = $userCrud->getUserById($userId);

    if ($user) {
        echo "Bienvenue, " . $user->firstname . " " . $user->lastname;
    } else {
        echo "Utilisateur introuvable.";
    }
} else {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
</head>
<body>
    <h1><?php echo "Bienvenue, " . $user->firstname . " " . $user->lastname; ?></h1>
</body>
</html>
