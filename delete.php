<?php
// Inclure le fichier de connexion à la base de données
include 'db.php';
include 'header.php';

// Vérifier si un ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparer la requête de suppression
    $query = "DELETE FROM livres WHERE id = :id";
    $stmt = $conn->prepare($query);

    // Lier le paramètre id
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Rediriger après la suppression
        header("Location: list.php");
        exit;
    } else {
        echo "Erreur lors de la suppression.";
    }
} else {
    echo "ID non spécifié.";
    exit;
}
?>
