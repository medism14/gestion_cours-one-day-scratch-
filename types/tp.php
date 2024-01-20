<?php 
    session_start();
    $_SESSION['section'] = 'tp';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de TD</title>
    <link rel="stylesheet" href="../index.css">
    <link ref="stylesheet" href="responsive_table.css">
    <link rel="shortcut icon" href="../univ.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.4/FileSaver.min.js"></script>
</head>
<style>
    /* Styles pour la classe section */
    section {
        display: block; /* Affichage en tant que bloc */
        color: black; /* Couleur du texte noir */
    }
    
    /* Styles pour l'élément avec l'ID 'upload' */
    #upload {
        cursor: pointer; /* Curseur pointeur au survol */
        font-size: 16px; /* Taille de police */
        border: 2px solid #fff; /* Bordure de 2px solide blanche */
        border-radius: 20px; /* Bordure arrondie */
    }
    
    /* Styles pour le premier élément div à l'intérieur de section */
    section div:first-child {
        text-align: center;  /* Alignement du texte au centre */
        margin-top: 50px; /* Marge supérieure de 50px */
    }

    /* Styles pour les boutons à l'intérieur des éléments div */
    div button {
        padding: 8px; /* Espacement intérieur de 8px */
        border-radius: 5px; /* Bordure arrondie de 5px */
        outline: none; /* Pas de contour */
        background: green; /* Fond vert */
        color: white; /* Couleur du texte blanc */
        border: 1px solid green; /* Bordure de 1px solide verte */
        cursor: pointer; /* Curseur pointeur au survol */
    }

    /* Styles pour les boutons de classe 'supprimer' */
    .supprimer {
        background-color: red; /* Fond rouge */
        border: 1px solid red; /* Bordure de 1px solide rouge */
    }

    /* Styles pour les écrans de largeur maximale de 650px */
    @media (max-width: 650px) {
        th {
            font-size: 12px; /* Taille de police pour les éléments th */
        }

        .change td {
            font-size: 12px; /* Taille de police pour les cellules du tableau avec la classe 'change' */
        }

        button {
            font-size: 12px; /* Taille de police pour les boutons */
        }
    }

    /* Styles pour les éléments de la classe 'pagination' */
    .pagination table {
        margin: 10px auto; /* Marge extérieure de 10px en haut et en bas, centré horizontalement */
    }

    .pagination td, .pagination th{
        border: 2px solid white; /* Bordure de 2px solide blanche pour les éléments td et th */
        border-radius: 15px; /* Bordure arrondie de 15px */
        color: black; /* Couleur du texte noir */
    }

    .pagination {
        display: block; /* Affichage en tant que bloc */
        overflow-x: auto; /* Défilement horizontal automatique en cas de dépassement */
    }

    #actualPage {
        background-color: blue; /* Fond bleu pour l'élément avec l'ID 'actualPage' */
        color: white; /* Couleur du texte blanc */
    }

</style>
<body>
    <?php include('nav.php'); ?>

    <!-- Section de contenu -->
    <section>
        <!-- Formulaire pour la sauvegarde de fichiers -->
        <div>
            <form action="backend/save.php" method="POST" enctype="multipart/form-data">
                <input id="upload" type="file" name="file">
                <button type="submit" name="sauvegardeFichier">Sauvegarder</button>
            </form>
        </div>

        <!-- Tableau d'affichage -->
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom du fichier</th>
                        <th>Type de fichier</th>
                        <th>Date</th>
                        <th>Télécharger</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        // Inclusion du fichier de base de données
                        include('../db.php');

                        // Détermination de la page actuelle et gestion de la pagination
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $page = max($page, 1);
                        $limit = 5;
                        $offset = ($page - 1) * $limit;
                        
                        // Récupération des données limitées à 5 enregistrements
                        $stmt = $pdo->prepare('SELECT * FROM FILES WHERE section = ? LIMIT ? OFFSET ? ');
                        $stmt->bindParam(1, $_SESSION['section']);
                        $stmt->bindParam(2, $limit, PDO::PARAM_INT);
                        $stmt->bindParam(3, $offset, PDO::PARAM_INT);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Comptage des enregistrements pour la pagination
                        $stmtCount = $pdo->prepare("SELECT count(*) as count FROM FILES WHERE section = ?");
                        $stmtCount->bindParam(1, $_SESSION['section']);
                        $stmtCount->execute();
                        $countResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
                        
                        $totalItems = $countResult['count'];
                        $totalPages = ceil($totalItems / $limit);
                        $i = 1;

                        if ($totalItems == 0) {
                            echo '<tr class="change"><td colspan="6">Aucun résultat</td></tr>';
                        }

                        if ($result) {
                            foreach ($result as $row) {
                                echo '<tr class="change">
                                        <td>' . $i . '</td>
                                        <td>' . $row['filename'] . '</td>
                                        <td>' . $row['type'] . '</td>
                                        <td>' . $row['date'] . '</td>
                                        <td><button type="submit" value="' . $row['id'] . '" class="telecharger">Télécharger</button></td>
                                        <td><button type="submit" value="' . $row['id'] . '" class="supprimer">Supprimer</button></td>
                                      </tr>';
                                $i++;
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <table>
                <tr>
                    <?php 
                        for ($i = 1; $i <= $totalPages; $i++) {
                            if ($i == $page) {
                                echo '<td id="actualPage" style="padding: 5px 15px;"><b>' . $i . '</b></td>';
                            } else {
                                echo '<td><b><a href="?page=' . $i . '" style="padding: 5px 15px;"> ' . $i . '</a></b></td>';
                            }
                        }
                    ?>
                </tr>
            </table>
        </div>
    </section>

    <?php include('footer.php') ?>

<script>
    // Sélection des boutons de classe 'telecharger'
    const telecharger = document.getElementsByClassName('telecharger');
    // Sélection des boutons de classe 'supprimer'
    const supprimer = document.getElementsByClassName('supprimer');

    // Traitement des boutons Télécharger avec Fetch API
    for (let button of telecharger) {
        let id = button.value;
        button.addEventListener('click', () => {
            // Utilisation de fetch pour télécharger le fichier
            fetch('backend/download.php?id=' + id)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Pas de réponse disponible');
                    }
                    return response.blob();
                })
                .then(blob => {
                    // Utilisation de fetch pour obtenir le nom du fichier
                    fetch('backend/getname.php?id=' + id)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Erreur');
                            }
                            return response.text();
                        })
                        .then(filename => {
                            // Téléchargement du fichier avec FileSaver.js
                            saveAs(blob, filename);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                })
                .catch(error => {
                    console.log(error);
                });
        });
    }

    // Traitement des boutons Supprimer avec Fetch API
    for (let button of supprimer) {
        let id = button.value;
        button.addEventListener('click', () => {
            // Utilisation de fetch pour supprimer le fichier
            fetch('backend/delete.php?id=' + id)
                .then(response => {
                    // Rechargement de la page après suppression
                    window.location.reload();
                })
                .catch(error => {
                    console.log(error);
                });
        });
    }
</script>

</body>
</html> 