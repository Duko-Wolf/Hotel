<?php 
include('includes/session.php'); 
include('includes/navbar.php'); 
include('includes/header.php'); 
include("functions/function.php"); 

$conn = dbConnect(); 

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}

// Verwijder kamer indien een POST-verzoek is gedaan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kamersID'])) {
    kamerverwijderen($conn);
}

// Haal alle kamers opnieuw op NA verwijdering
$query = "SELECT * FROM kamers";
$stmt = $conn->prepare($query);
$stmt->execute();
$kamers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/global.css" />
    <title>Kamers Beheer</title>
</head>
<body>

<main>
    <?php foreach ($kamers as $kamer): ?>
        <section class="kamer">
            <h2><?= htmlspecialchars($kamer['kamerNaam']) ?></h2>
            <p><?= htmlspecialchars($kamer['kamerBeschrijving']) ?></p>
            <p class="prijs">Prijs per nacht: €<?= number_format($kamer['prijs'], 2, ',', '.') ?></p>
            
            <form method="post">
                <input type="hidden" name="kamersID" value="<?= $kamer['kamersID'] ?>">
                <button type="submit" onclick="return confirm('Weet je zeker dat je deze kamer wilt verwijderen?');">
                    Verwijderen
                </button>
            </form>
        </section>
    <?php endforeach; ?>

    <section>
        <article>
            <h2>Voeg een nieuwe kamer toe</h2>
            <form method="post" enctype="multipart/form-data">
                <label for="kamerNaam">Kamernaam:</label>
                <input type="text" id="kamerNaam" name="kamerNaam" required>

                <label for="kamerBeschrijving">Kamer beschrijving:</label>
                <textarea id="kamerBeschrijving" name="kamerBeschrijving" required></textarea>

                <label for="prijs">Prijs:</label>
                <input type="number" step="0.01" id="prijs" name="prijs" required>

                <input type="submit" value="Toevoegen" name="verstuur">
            </form>
        </article>
    </section>

    <?php
    // Functie voor toevoegen oproepen NA het formulier
    kamerToevoegen($conn);
    ?>

</main>

<?php include('includes/footer.php'); ?>
</body>
</html>
