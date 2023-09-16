<?php
require_once('Class/.php');
$userCrud = new UserCrud($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $userIdToDelete = $_POST['user_id'];
    $userToDelete = $userCrud->getUserById($userId); // Obtenir les informations de l'utilisateur à supprimer
    if ($userToDelete) {
        $deleted = $userCrud->deleteUser($id);
        if ($deleted) {
            echo "L'utilisateur avec l'ID $id (Login: {$id['login']}) a été supprimé avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la suppression de l'utilisateur avec l'ID $id.";
        }
    } else {
        echo "Utilisateur non trouvé avec l'ID$id.";
    }
}

$users = $userCrud->getUsers();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Utilisateurs</title>
</head>
<body>
    <h2>Liste des Utilisateurs</h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Prénom</th>
                <th>Nom de Famille</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->login; ?></td>
                    <td><?php echo $user->firstname; ?></td>
                    <td><?php echo $user->lastname; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                            <input type="submit" name="delete" value="Supprimer">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
