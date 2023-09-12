<?php
session_start();

require_once('Class/User.php');

$userCrud = new UserCrud($db);

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $user = $userCrud->getUserById($userId);

    // Vérifiez si le formulaire a été soumis (méthode POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérez les données du formulaire tout en appliquant htmlspecialchars et trim
        $login = trim(htmlspecialchars($_POST['login']));
        $firstname = trim(htmlspecialchars($_POST['firstname']));
        $lastname = trim(htmlspecialchars($_POST['lastname']));
        $password = $_POST['password'];

        // Mettez à jour les données de l'utilisateur en utilisant la méthode updateUser
        $updated = $userCrud->updateUser($userId, $login, $firstname, $lastname, $password);

        if ($updated) {
            // Les données de l'utilisateur ont été mises à jour avec succès
            echo "Les informations de l'utilisateur ont été mises à jour avec succès.";
            // Vous pouvez également mettre à jour les informations affichées à l'écran
            $user = $userCrud->getUserById($userId);
        } else {
            echo "Une erreur s'est produite lors de la mise à jour des informations de l'utilisateur.";
        }
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
        <input type="text" value="<?php echo $user->login; ?>" name="login">

        <label for="firstname">Your First Name :</label>
        <input type="text" value="<?php echo $user->firstname; ?>" name="firstname">

        <label for="lastname">Your Last Name :</label>
        <input type="text" value="<?php echo $user->lastname; ?>" name="lastname">

        <label for="password">Password : </label>
        <input type="password" name="password" placeholder="********">

        <input type="submit" value="Mettre à jour">
    </form>
    <a href="logout.php"><button>deconnexion</button></a>
</body>
</html>
