<?php 
ob_start();

if (isset($_POST['sauvegardeFichier']) && $_FILES['file']) {
    session_start();
    $file = $_FILES['file'];

    // Vérification si le nom de fichier est présent
    if (!$file['name']) {
        header('location:' . $_SERVER['HTTP_REFERER']);
        ob_end_flush();
        die();
    }

    $fileData = file_get_contents($file['tmp_name']);

    $section = $_SESSION['section'];
    $fileName = $file['name'];
    $fileType = $file['type'];

    // Fonction pour obtenir l'extension à partir du type MIME
    function mimeToExtension($mimeType) {
        $mimeMap = [
            'application/pdf' => 'pdf',
            'application/msword' => 'doc',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'text/plain' => 'txt',
            'text/html' => 'webp',
            'application/vnd.ms-powerpoint' => 'ppt',
            // Ajoutez d'autres types MIME et leurs extensions correspondantes ici
        ];
    
        return isset($mimeMap[$mimeType]) ? $mimeMap[$mimeType] : null;
    }

    $fileType = mimeToExtension($fileType);

    // Vérification si le type de fichier est valide
    if ($fileType == null || $fileType == '') {
        header('location:' . $_SERVER['HTTP_REFERER']);
        ob_end_flush();
        die();
    }

    $actualDate = date('Y-m-d H:i:s');
    
    include('../../db.php');

    try {
        // Préparation et exécution de la requête d'insertion
        $stmt = $pdo->prepare("INSERT INTO FILES(filename, section, type, date, data) VALUES(?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $fileName);
        $stmt->bindParam(2, $section);
        $stmt->bindParam(3, $fileType);
        $stmt->bindParam(4, $actualDate);
        $stmt->bindParam(5, $fileData, PDO::PARAM_LOB);

        $stmt->execute();
    } catch(PDOException $e) {
        // Affichage du message d'erreur en cas d'échec
        echo $e->getMessage();
        ob_end_flush(); 
        die();
    }

    // Redirection vers la page précédente après l'insertion
    header('location:' . $_SERVER['HTTP_REFERER']);
    ob_end_flush();
    die();
}
?>
