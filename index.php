<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définition de l'encodage des caractères -->
    <meta charset="UTF-8">
    <!-- Définition de la taille de la fenêtre et du niveau de zoom initial -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page -->
    <title>Page d'accueil</title>
    <!-- Lien vers le fichier CSS pour le style de la page -->
    <link rel="stylesheet" href="index.css">
    <!-- Lien vers l'icône de la page -->
    <link rel="shortcut icon" href="univ.png">
</head>
<style>

</style>
<body>
    <!-- Inclusion de la barre de navigation -->
    <?php include('nav.php'); ?>

    <section>
        <!-- Titre principal de la page -->
        <h1 style="margin-top: 40px;">Bienvenue sur la plateforme éducative</h1>

        <!-- Introduction de la page -->
        <p style="margin-bottom: 20px;">
            Bienvenue sur votre portail éducatif interactif. Ici, vous pouvez facilement télécharger et accéder à vos cours, travaux dirigés (TD) et travaux pratiques (TP).
        </p>

        <!-- Guide d'utilisation de la plateforme -->
        <h3>Guide d'utilisation :</h3>
        <p>
            Naviguez à travers les différentes sections du menu pour uploader et télécharger les documents éducatifs. Vous trouverez des ressources classées par matière et niveau d'étude.
        </p>
        <p>
            Une interface sécurisée avec authentification est mise en place pour garantir la qualité des contributions. Seuls les enseignants et le personnel autorisé peuvent déposer des cours ou des documents.
        </p>

        <!-- Informations supplémentaires -->
        <h3>Informations supplémentaires :</h3>
        <p>
            Vous trouverez également des informations utiles sur l'université, les événements à venir, et des liens vers d'autres ressources éducatives.
        </p>
        <p>
            Le créateur du site et les informations de contact sont disponibles en bas de la page.
        </p>
    </section>

    <!-- Inclusion du pied de page -->
    <?php include('footer.php') ?>
</body>
</html>