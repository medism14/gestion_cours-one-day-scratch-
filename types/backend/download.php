<?php 
if (isset($_GET['id'])) {
    try {
        // Récupération de l'ID depuis les paramètres GET
        $id = $_GET['id'];

        // Inclusion du fichier de base de données
        include('../../db.php');

        // Préparation de la requête de sélection
        $stmt = $pdo->prepare("SELECT * FROM FILES WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        
        // Exécution de la requête
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification de l'existence de la ligne
        if ($row) {
            // Définition des entêtes pour le téléchargement
            header("Content-Type:" . $row['type']);
            header("Content-Disposition: attachment; filename=\"" . $row['filename'] . "\"");

            // Affichage des données du fichier
            echo $row['data'];
        }
    } catch (PDOException $e) {
        // Affichage du message d'erreur en cas d'échec
        echo $e->getMessage();
    }
}
?>
