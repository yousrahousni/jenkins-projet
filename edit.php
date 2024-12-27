<?php
// Inclure le fichier de connexion à la base de données
include 'db.php';
include 'header.php';

// Vérifier si un ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations du livre
    $query = "SELECT * FROM livres WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $livre = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si le livre n'existe pas
    if (!$livre) {
        echo "Livre introuvable.";
        exit;
    }
} else {
    echo "ID non spécifié.";
    exit;
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $annee_publication = $_POST['annee_publication'];
    $genre = $_POST['genre'];

    // Mise à jour du livre
    $query = "UPDATE livres SET titre = :titre, auteur = :auteur, annee_publication = :annee_publication, genre = :genre WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':auteur', $auteur);
    $stmt->bindParam(':annee_publication', $annee_publication);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: list.php");
        exit;
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Modifier un livre</title>
</head>
<body>
    <h1>Modifier un livre</h1>
    <form method="POST">
        <label>Titre :</label><br>
        <input type="text" name="titre" value="<?php echo htmlspecialchars($livre['titre']); ?>" required><br><br>

        <label>Auteur :</label><br>
        <input type="text" name="auteur" value="<?php echo htmlspecialchars($livre['auteur']); ?>" required><br><br>

        <label>Année de publication :</label><br>
        <input type="number" name="annee_publication" value="<?php echo htmlspecialchars($livre['annee_publication']); ?>" required><br><br>

        <label>Genre :</label><br>
        <input type="text" name="genre" value="<?php echo htmlspecialchars($livre['genre']); ?>" required><br><br>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
