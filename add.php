<?php include 'db.php';
include 'header.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $annee_publication = $_POST['annee_publication'];
    $genre = $_POST['genre'];

    $sql = "INSERT INTO livres (titre, auteur, annee_publication, genre) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$titre, $auteur, $annee_publication, $genre]);

    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Ajouter un livre</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <h1>Ajouter un nouveau livre</h1>
    <form action="add.php" method="post" class="mt-4">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre du livre</label>
        <input type="text" class="form-control" id="titre" name="titre" required>
    </div>
    <div class="mb-3">
        <label for="auteur" class="form-label">Auteur</label>
        <input type="text" class="form-control" id="auteur" name="auteur" required>
    </div>
    <div class="mb-3">
        <label for="annee_publication" class="form-label">Année de publication</label>
        <input type="number" class="form-control" id="annee_publication" name="annee_publication" required>
    </div>
    <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" required>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>

</body>
</html>
