<?php require_once(__DIR__ . '/../includes/header.php'); ?>


<head>
 
    <link rel="stylesheet" href="dashboardAdmin.css">
</head>
<body>


    <main>
        <section class="admin-space">
            <h1>ESPACE ADMINISTRATEUR</h1>
            <div class="grid-container">
                <div class="grid-item green">
                    <a href="/dashboardAdmin/creerCompte.php">CRÉER UN COMPTE UTILISATEUR</a>
                </div>
                <div class="grid-item blue">
                    <a href="#">MODIFIER LES SERVICES</a>
                </div>
                <div class="grid-item light-green">
                    <a href="#">MODIFIER LES ANIMAUX</a>
                </div>
                <div class="grid-item brown">
                    <a href="#">MODIFIER LES HABITATS</a>
                </div>
                <div class="grid-item light-blue">
                    <a href="#">AFFICHER LES COMPTES RENDU DE L'ANIMAL</a>
                </div>
                <div class="grid-item dark-green">
                    <a href="#">DASH BOARD</a>
                </div>
            </div>
        </section>
    </main>


    <?php require_once (__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>