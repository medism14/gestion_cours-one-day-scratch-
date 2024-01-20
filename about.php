<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Balises meta pour la définition de l'encodage et de l'échelle d'affichage -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page -->
    <title>A propos de nous - EMD</title>
    <!-- Liens vers les fichiers de style et l'icône -->
    <link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" href="univ.png">
</head>
<style>
    /* Styles pour les éléments de la page */
    h1 {
        color: black; /* Couleur du texte pour la balise h1 */
    }

    section {
        display: flex; /* Affichage en tant que conteneur flexible */
        gap: 50px; /* Espacement entre les éléments enfants de la section */
        align-items: center; /* Alignement vertical au centre */
        justify-content: center; /* Alignement horizontal au centre */
        min-height: calc(100vh - 180px); /* Hauteur minimale de la section calculée en fonction de la hauteur de la vue */
    }

    section p {
        font-size: 15px; /* Taille de police pour les paragraphes de la section */
        font-style: italic; /* Style de police italique */
        color: black; /* Couleur du texte pour les paragraphes de la section */
    }

    /* Styles pour les écrans de largeur maximale de 620px */
    @media screen and (max-width: 620px) {
        section {
            margin-top: 20px; /* Marge supérieure de la section pour les écrans plus petits */
            min-height: calc(100vh - 200px); /* Hauteur minimale ajustée pour les écrans plus petits */
            display: block; /* Affichage en tant que bloc pour les écrans plus petits */
        }
    }

</style>
<body>
    <?php include('nav.php'); ?>

    <!-- En-tête h1 avec style en ligne -->
    <h1 style="text-align:center; text-decoration:underline; height:20px; font-style: italic; margin-top: 20px;">EMD</h1>

    <!-- Section de contenu -->
    <section>
        <!-- Paragraphes décrivant l'université -->
        <p>
            Fondée il y a quelques années, EMD est une université privée reconnue pour l'excellence de son enseignement et la qualité de sa recherche. Nous sommes fiers de former des étudiants qui deviennent des professionnels compétents, prêts à relever les défis de demain.
        </p>
        <p>
            Notre établissement se distingue par une approche pédagogique innovante, axée sur la pratique et l'expérience en milieu professionnel. Nos programmes d'études couvrent divers domaines, allant des sciences humaines aux technologies avancées, et sont constamment mis à jour pour rester en phase avec les évolutions du marché du travail.
        </p>
        <p>
            EMD est aussi un centre de recherche dynamique, où étudiants et enseignants travaillent ensemble sur des projets d'avant-garde, contribuant ainsi au progrès des connaissances et à l'innovation technologique.
        </p>
    </section>

    <?php include('footer.php') ?>

</body>
</html>
