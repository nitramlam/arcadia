<?php require_once (__DIR__ . '/../includes/header.php'); ?>
<?php
require '../config/db.php';

// Obtenir une connexion à la base de données
$pdo = getDatabaseConnection();

if ($pdo) {
    // Sélection et affichage des données des habitats
    $sql = "SELECT * FROM HABITAT";
    $stmt = $pdo->query($sql);
    $habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Récupérer les animaux par habitat
    $animalsByHabitat = [];
    foreach ($habitats as $habitat) {
        $stmt = $pdo->prepare("SELECT * FROM ANIMAL WHERE habitat = ?");
        $stmt->execute([$habitat['nom']]);
        $animalsByHabitat[$habitat['nom']] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<link rel="stylesheet" href="style.css">

<main>
    <div class="habitats">
        <div class="introHabitats">
            <h1 class="titreHabitats">NOS HABITATS</h1>
            <p class="paragrapheHabitats">
                Découvrez nos trois habitats distincts : la jungle, les marais et la savane, conçus de manière
                écologique et adaptée. Chaque environnement offre à nos animaux un espace immersif qui respecte leur
                bien-être et leur comportement naturel. Notre engagement envers la préservation de la biodiversité se
                reflète dans chaque détail de ces écosystèmes uniques.
            </p>
            <img src="assets/panthere-habitats.png" alt="" class="panthere">
        </div>

        <div class="habitats-list">
            <?php
            // Affichage des habitats dans une liste
            foreach ($habitats as $index => $habitat) {
                echo '<div class="habitat">';
                echo '<div class="habitat-header" onclick="toggleHabitatDetails(' . $index . ')">';
                echo '<img class="habitat-image" src="' . $habitat['image_path'] . '" alt="' . htmlspecialchars($habitat['nom']) . '"/>';
                echo '<div class="habitat-overlay">';
                echo '<span class="habitat-link">' . htmlspecialchars($habitat['nom']) . "</span>";
                echo '</div>';
                echo '</div>';
                echo '<div id="habitat-details-' . $index . '" class="habitat-details" style="display:none;">';
                echo '<h2>' . htmlspecialchars($habitat['nom']) . '</h2>';
                echo '<p>' . htmlspecialchars($habitat['description']) . '</p>';
                echo '<div class="animal-list">';
                echo '<h3>Animaux dans cet habitat :</h3>';
                foreach ($animalsByHabitat[$habitat['nom']] as $animal) {
                    echo '<div class="animal-item">';
                    echo '<img src="' . ($animal['image_path'] ?: 'default-animal.jpg') . '" alt="' . htmlspecialchars($animal['nom']) . '" class="animal-image"/>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</main>

<script>
function toggleHabitatDetails(index) {
    const details = document.getElementById(`habitat-details-${index}`);
    if (details) {
        details.style.display = details.style.display === 'none' ? 'block' : 'none';
    }
}
</script>

<?php require_once (__DIR__ . '/../includes/footer.php'); ?>