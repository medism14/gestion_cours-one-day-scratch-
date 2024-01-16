<?php 
    // $host="127.0.0.1";
    // $user="root";
    // $database="gestioncours";
    // $password="";

    $host="localhost";
    $user = "id21787178_yonistoussaint";
    $database = "id21787178_gestioncours";
    $password = "yonis123@A";

    try {
        $pdo = new pdo("mysql:host=$host;dbname=$database",$user, $password);
    } catch (PDOException $e) {
        Echo "Vous avez fait une erreur dans la connexion";
    }
?>