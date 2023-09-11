<?php
class UserCrud
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createUser($username, $firstname, $lastname, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $stmt = $this->db->prepare("INSERT INTO users (login, firstname, lastname, password) VALUES (:login, :firstname, :lastname, :password)");
        $stmt->bindParam(':login', $username);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':password', $hashedPassword);
    
        if ($stmt->execute()) {
            $userId = $this->db->lastInsertId();
    
            $_SESSION['user_id'] = $userId;
    
            return $this->getUserById($userId);
        } else {
            return false;
        }
    }
    

    public function getUsers()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    public function loginUser($username, $password)
{
    // Recherchez l'utilisateur par son nom d'utilisateur (login)
    $stmt = $this->db->prepare("SELECT * FROM users WHERE login = :login");
    $stmt->bindParam(':login', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_OBJ);

    // Vérifiez si l'utilisateur existe et si le mot de passe est valide
    if ($user && password_verify($password, $user->password)) {
        // L'utilisateur est connecté avec succès
        $_SESSION['user_id'] = $user->id;
        return $user;
    } else {
        // Échec de la connexion
        return false;
    }
}


    public function updateUser($id, $username, $firstname, $lastname, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("UPDATE users SET username = :username, firstname = :firstname, lastname = :lastname, password = :password WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':password', $hashedPassword);

        return $stmt->execute();
    }

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

try {
    $db = new PDO('mysql:host=localhost;dbname=moduleconnexionb2', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userCrud = new UserCrud($db);

    // Exemple d'utilisation
    $users = $userCrud->getUsers();
    print_r($users);
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>
