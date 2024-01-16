<?php 
if (isset($_GET['id'])) {
    
    try {
        $id = $_GET['id'];

        include('../../db.php');

        $stmt = $pdo->prepare("SELECT * FROM FILES WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            header("Content-Type:" . $row['type']);
            header("Content-Disposition: attachment; filename\"" . $row['filename'] . "\"");

            echo $row['data'];
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>