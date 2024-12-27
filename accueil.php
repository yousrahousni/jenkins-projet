<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Gestion de Bibliothèque</title>
</head>
<body>
    <header>
        <h1>Gestion de Bibliothèque</h1>
        <nav>
            <a href="list.php" class="btn btn-outline-light">Liste des livres</a>
            <a href="add.php" class="btn btn-outline-light">Ajouter un livre</a>
            <form action="logout.php" method="post" style="display: inline;">
                <button type="submit" class="btn btn-danger">Se déconnecter</button>
            </form>
        </nav>
    </header>
    <main class="container">
        <p class="lead">Bienvenue dans votre gestionnaire de bibliothèque personnelle, <strong><?php echo htmlspecialchars($_SESSION['nom_utili']); ?></strong> !</p>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

