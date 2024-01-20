<?php 
if (isset($_GET['id'])) {
    try {
        // Récupération de l'ID depuis les paramètres GET
        $id = $_GET['id'];

        // Inclusion du fichier de base de données
        include('../../db.php');

        // Préparation de la requête de sélection du nom de fichier
        $stmt = $pdo->prepare("SELECT filename FROM FILES WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        
        // Exécution de la requête
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Affichage du nom de fichier
        echo $row['filename'];

    } catch (PDOException $e) {
        // Affichage du message d'erreur en cas d'échec
        echo $e->getMessage();
    }
}
?>
