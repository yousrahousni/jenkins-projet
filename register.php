<?php
// Inclure la connexion à la base de données
include 'db.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom_utili = $_POST['nom_utili'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Vérifier si l'email ou le nom d'utilisateur existe déjà
    $query = "SELECT * FROM utilisateurs WHERE nom_utili = :nom_utili OR email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nom_utili', $nom_utili, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $error = "Ce nom d'utilisateur ou cet email est déjà utilisé.";
    } else {
        // Hacher le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insérer les données dans la table utilisateurs
        $query = "INSERT INTO utilisateurs (nom_utili, password, email) VALUES (:nom_utili, :password, :email)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nom_utili', $nom_utili, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Rediriger vers la page de connexion
            header("Location: accueil.php");
            exit;
        } else {
            $error = "Erreur lors de l'inscription.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Inscription</title>
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh;">

    <div class="container">
        <h1 class="text-center mb-4">Inscription</h1>

        <?php if (isset($error)) echo "<p style='color: red; text-align: center;'>$error</p>"; ?>

        <form method="POST" action="register.php">
            <div class="mb-3">
                <label for="nom_utili" class="form-label">Nom d'utilisateur :</label>
                <input type="text" name="nom_utili" id="nom_utili" class="form-control form-control-sm" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" name="password" id="password" class="form-control form-control-sm" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" id="email" class="form-control form-control-sm" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
        </form>

        <p class="text-center mt-3">Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
    </div>

</body>
</html>

