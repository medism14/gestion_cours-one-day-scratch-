<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A propos de nous - EMD</title>
    <link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" href="univ.png">
</head>
    <style>
        h1 {
            color: black;
        }    

        section {
            display: flex;
            gap: 50px;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 180px);
        }

        section p {
            font-size: 15px;
            font-style: italic;
            color: black;
        }

        @media screen and (max-width: 620px) {
            section {
                margin-top: 20px;
                min-height: calc(100vh - 200px);
                display: block;
            }
        }

    </style>
<body>
    <?php include('nav.php'); ?>

        <h1 style="text-align:center; text-decoration:underline; height:20px; font-style: italic; margin-top: 20px;">EMD</h1>

    <section>
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

    <?php  include('footer.php') ?>

</body>
</html>
