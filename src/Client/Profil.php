<?php
session_start();

require_once('Class/User.php');

$userCrud = new UserCrud($db);

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Récupérer les données de l'utilisateur actuel
    $user = $userCrud->getUserById($userId);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update'])) {
            $login = trim(htmlspecialchars($_POST['login']));
            $firstname = trim(htmlspecialchars($_POST['firstname']));
            $lastname = trim(htmlspecialchars($_POST['lastname']));
            $password = $_POST['password'];

            $updated = $userCrud->updateUser($userId, $login, $firstname, $lastname, $password);

            if ($updated) {
                // Rediriger l'utilisateur avec l'ID de l'utilisateur dans l'URL
                header("Location: Profil.php?id=$userId");
                exit();  
            } else {
                //echo "Une erreur s'est produite lors de la mise à jour des informations de l'utilisateur.";
            }
        } elseif (isset($_POST['delete'])) {
            // Récupérer l'ID de l'utilisateur à supprimer à partir de l'URL
            $idToDelete = isset($_GET['id']) ? $_GET['id'] : null;

            if ($idToDelete) {
                // Supprimer l'utilisateur
                $deleted = $userCrud->deleteUser($idToDelete);

                if ($deleted) {
                    header("Location: index.php");
                    exit();
                } else {
                    //echo "Une erreur s'est produite lors de la suppression du compte.";
                }
            } else {
               // echo "ID de l'utilisateur à supprimer non spécifié.";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php
        if ($user) {
            echo "Bienvenue, " . $user['login'] . " " . $user['lastname'];
        } else {
            echo "Bienvenue, utilisateur inconnu";
        }
        ?>
        <div class="text">Profil</div>
        <form action="" method="post">
            <div class="form-row">
                <div class="input-data">
                    <input type="text" value="<?php echo isset($userData['login']) ? $userData['login'] : ''; ?>" name="login">
                    <label for="login">Your login :</label>
                    <div class="underline"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" value="<?php echo isset($userData['firstname']) ? $userData['firstname'] : ''; ?>" name="firstname">
                    <label for="firstname">Your First Name :</label>
                    <div class="underline"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" value="<?php echo isset($userData['lastname']) ? $userData['lastname'] : ''; ?>" name="lastname">
                    <label for="lastname">Your Last Name :</label>
                    <div class="underline"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="password" name="password" placeholder="********">
                    <label for="password">Password :</label>
                    <div class="underline"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="input-data">
                    <button type="submit" class="btn">Mettre à jour</button>
                    <button type="submit" name="delete" class="btn">Supprimer le compte</button>
                    <a href="logout.php"><button class="btn">Déconnexion</button></a>
                    <div class="inner"></div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
