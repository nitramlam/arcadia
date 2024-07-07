<?php
require '../config/db.php';

// Obtenir une connexion à la base de données
$pdo = getDatabaseConnection();

if ($pdo) {
    // Sélection et affichage des données
    $sql = "SELECT * FROM HABITAT";
    $stmt = $pdo->query($sql);
    $habitats = $stmt->fetchAll();
}
?>

<?php require_once (__DIR__ . '/../includes/header.php'); ?>

<link rel="stylesheet" href="style.css">

<main>
    <div class="habitats">
        <div class="introHabitats">
            <h1 class="titreHabitats"> NOS HABITATS</h1>
            <p class="paragrapheHabitats">
                Découvrez nos trois habitats distincts : la jungle, les marais et la savane, conçus de manière
                écologique et adaptée. Chaque environnement offre à nos animaux un espace immersif qui respecte leur
                bien-être et leur comportement naturel. Notre engagement envers la préservation de la biodiversité se
                reflète dans chaque détail de ces écosystèmes uniques.

            </p>
            <img src="assets/panthere-habitats.png" alt="" class="panthere">
        </div>

        <div class="row">
            <?php
            // Affichage des habitats dans une liste
            foreach ($habitats as $habitat) {
                echo '<a class="col-md-4">';
                echo "<h2>" . htmlspecialchars($habitat['nom']) . "</h2>";
                echo "<p>" . htmlspecialchars($habitat['description']) . "</p>";
                echo "<p><strong>Commentaire:</strong> " . htmlspecialchars($habitat['commentaire_habitat']) . "</p>";
                echo '<img src="' . $habitat['image_path'] . '"/>';
                echo "</a>";
            }
            ?>
        </div>
    </div>
</main>

<?php require_once (__DIR__ . '/../includes/footer.php'); ?>