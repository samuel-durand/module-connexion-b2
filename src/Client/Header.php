<header>
        <div class="burger-menu" id="burger-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </header>

    <nav class="sidebar" id="sidebar">
        <ul>
            <li><a href="Index.php">Accueil</a></li>
            <?php
            // Vérifiez si l'utilisateur est connecté
            if (isset($_SESSION['user_id'])) {
                // Si connecté, affichez les liens du profil et de déconnexion
                echo '<li><a href="profil.php">Profil</a></li>';
                echo '<li><a href="logout.php">Déconnexion</a></li>';
            } else {
                // Si non connecté, affichez le lien de connexion et d'inscription
                echo '<li><a href="Login.php">Connexion</a></li>';
                echo '<li><a href="inscription.php">Inscription</a></li>';
            }
            ?>
        </ul>
    </nav>