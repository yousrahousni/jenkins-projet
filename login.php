<?php
// Démarrer la session
session_start();

// Inclure la connexion à la base de données
include 'db.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_utili = $_POST['nom_utili'];
    $password = $_POST['password'];

    // Requête pour récupérer l'utilisateur
    $query = "SELECT * FROM utilisateurs WHERE nom_utili = :nom_utili";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nom_utili', $nom_utili, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie, stocker les informations de l'utilisateur en session
        $_SESSION['user_id'] = $user['id_utili'];
        $_SESSION['nom_utili'] = $user['nom_utili'];
        header("Location: accueil.php"); // Rediriger vers la page d'accueil
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Connexion</title>
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh;">

    <div class="container">
        <h1 class="text-center mb-4">Connexion</h1>

        <?php if (isset($error)) echo "<p style='color: red; text-align: center;'>$error</p>"; ?>

        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="nom_utili" class="form-label">Nom d'utilisateur :</label>
                <input type="text" class="form-control form-control-sm" name="nom_utili" id="nom_utili" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control form-control-sm" name="password" id="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
        <p class="text-center mt-3">Vous n'avez pas de compte? <a href="register.php">Inscrivez-vous ici</a></p>
    </div>

</body>
</html>

