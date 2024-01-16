<?php 
if (isset($_GET['id'])) {
    
    try {
        $id = $_GET['id'];

        include('../../db.php');

        $stmt = $pdo->prepare("SELECT filename FROM FILES WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo $row['filename'];

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>