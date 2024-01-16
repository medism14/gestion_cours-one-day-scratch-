<?php 
if (isset($_GET['id'])) {
    
    try {
        $id = $_GET['id'];

        include('../../db.php');

        $stmt = $pdo->prepare("DELETE FROM FILES WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>