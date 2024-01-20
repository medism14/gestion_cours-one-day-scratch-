<?php
    // Configuration des paramètres de connexion à la base de données

    // Configuration pour un serveur local
    // $host = "127.0.0.1";
    // $user = "root";
    // $database = "gestioncours";
    // $password = "";

    // Configuration pour un serveur distant
    $host = "localhost";
    $user = "id21787178_yonistoussaint";
    $database = "id21787178_gestioncours";
    $password = "yonis123@A";

    try {
        // Tentative de connexion à la base de données MySQL
        $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    } catch (PDOException $e) {
        // En cas d'échec de la connexion, affiche un message d'erreur
        echo "Vous avez fait une erreur dans la connexion";
    }
?>
