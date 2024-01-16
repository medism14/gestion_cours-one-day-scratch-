<?php 
    session_start();
    $_SESSION['section'] = 'cours';
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
    section {
        display: block;
        color: black;
    }
    
    #upload {
        cursor: pointer;
        font-size: 16px;
        border: 2px solid #fff;
        border-radius: 20px;
    }
    
    section div:first-child {
        text-align: center; 
        margin-top: 50px;
    }

    div button {
        padding: 8px;
        border-radius: 5px;
        outline: none;
        background: green;
        color: white;
        border: 1px solid green;    
        cursor: pointer;
    }

    .supprimer {
        background-color: red;
        border: 1px solid red;
    }

    @media (max-width: 650px) {
        th {
            font-size: 12px;
        }

        .change td {
            font-size: 12px;
        }

        button {
            font-size: 12px;
        }
    }

    .pagination table {
        margin: 10px auto;
    }

    .pagination td, .pagination th{
        border: 2px solid white;
        border-radius: 15px;
        color: black;
    }

    .pagination {
        display: block;
        overflow-x: auto;
    }

    #actualPage {
        background-color: blue;
        color: white;
    }

</style>
<body>
    <?php include('nav.php'); ?>

    <section>
        <!-- Recuperations des fichiers -->
        <div>
            <form action="backend/save.php" method="POST" enctype="multipart/form-data">
                <input id="upload" type="file" name="file">
                <button type="submit" name="sauvegardeFichier">Sauvegarder</button>
            </form>
        </div>

        <!-- Tableau display -->
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du fichier</th>
                    <th>Type de fichier</th>
                    <th>Date</th>
                    <th>Telecharger</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                        include('../db.php');

                        //Déterminer la page actuelle et ce qui va avec
                        $page = isset($_GET['page']) ? (int)$_GET['page']: 1;
                        $page = max ($page, 1);

                        $limit = 5;
                        $offset = ($page - 1) * $limit;
                        
                        //Donnée des 5 valeurs
                        $stmt = $pdo->prepare('SELECT * FROM FILES WHERE section = ? LIMIT ? OFFSET ? ');
                        $stmt->bindParam(1, $_SESSION['section']);
                        $stmt->bindParam(2, $limit, PDO::PARAM_INT);
                        $stmt->bindParam(3, $offset, PDO::PARAM_INT);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        //Comptage et repartissage
                        $stmtCount = $pdo->prepare("SELECT count(*) as count FROM FILES WHERE section = ?");
                        $stmtCount->bindParam(1, $_SESSION['section']);
                        $stmtCount->execute();
                        $countResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
                        
                        $totalItems = $countResult['count'];
                        $totalPages = ceil($totalItems / $limit);

                        $i = 1;

                        if ($totalItems == 0) {
                            echo '
                                <tr class="change">
                                    <td colspan="6">Aucun résultat</td>
                                </tr>';
                        }

                        if ($result) {
                            foreach ($result as $row) {
                                echo '
                                <tr class="change">
                                    <td>' . $i . '</td>
                                    <td>' . $row['filename'] . '</td>
                                    <td>' . $row['type'] . '</td>
                                    <td>' . $row['date'] . '</td>
                                    <td><button type="submit" value=" ' . $row['id'] . '" class="telecharger">Télécharger</button></td>
                                    <td><button type="submit" value=" ' . $row['id'] . '" class="supprimer">Supprimer</button></td>
                                    </tr>';
                                $i++;
                            }
                        }
                        
                    ?>
                <tbody>
            </table>
        </div>
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
        const telecharger = document.getElementsByClassName('telecharger');
        const supprimer = document.getElementsByClassName('supprimer');

        //BOUTONS TELECHARGER FETCH
        for (let button of telecharger) {
            let id = button.value;
            button.addEventListener('click', () => {
                fetch('backend/download.php?id=' + id)
                .then(response => {
                    if (!response) {
                        throw new Error('pas de reponse dispo');
                    }
                    return response.blob();
                })
                .then(blob => {
                    fetch('backend/getname.php?id=' + id)
                    .then(response => {
                        if (!response) {
                            throw new Error('Error');
                        }
                        return response.text();
                    })
                    .then(filename => {
                        saveAs(blob, filename); 
                    })
                    .catch(error => {
                        console.log(error)
                    })
                })
                .catch(error => {
                    console.log(error);
                });
            })
        }

        //BOUTONS SUPPRIMER FETCH
        for (let button of supprimer ) {
            let id = button.value;
            button.addEventListener('click', () => {
                fetch('backend/delete.php?id=' + id)
                .then(response => {
                    window.location.reload();
                })
                .catch(error => {
                    console.log(error);
                })
            })
        }
    </script>
</body>
</html> 