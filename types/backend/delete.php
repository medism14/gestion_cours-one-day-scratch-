<?php 
if (isset($_GET['id'])) {
    try {
        // Récupération de l'ID depuis les paramètres GET
        $id = $_GET['id'];

        // Inclusion du fichier de base de données
        include('../../db.php');

        // Préparation de la requête de suppression
        $stmt = $pdo->prepare("DELETE FROM FILES WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        
        // Exécution de la requête
        $stmt->execute();
    } catch (PDOException $e) {
        // Affichage du message d'erreur en cas d'échec
        echo $e->getMessage();
    }
}
?>
