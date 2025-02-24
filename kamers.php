<?php include('includes/session.php'); ?>
<?php
require 'functions/function.php'; // Inclusief het database verbindingsbestand

$conn = dbConnect();
// Query om alle kamers op te halen
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
    <link rel="stylesheet" href="styling/global.css"/>
    <title>Kamers Overzicht</title>
</head>
<body>
<?php include('includes/navbar.php'); ?>
<?php include('includes/header.php'); ?>

    <?php foreach ($kamers as $kamer): ?>
        <section class="kamer">
            <h2><?= htmlspecialchars($kamer['kamerNaam']) ?></h2>
            <p><?= htmlspecialchars($kamer['kamerBeschrijving']) ?></p>
            <p class="prijs">Prijs per nacht: €<?= number_format(htmlspecialchars($kamer['prijs']), 2, ',', '.') ?></p>

            <!-- Foto weergeven, als beschikbaar -->
            <?php if (!empty($kamer['kamerFoto'])): ?>
               <div class="container-kamerFoto"> <img src="uploads/<?= htmlspecialchars($kamer['kamerFoto']) ?>" alt="Kamer foto" class="kamerFoto"></div>
            <?php else: ?>
                <p>Geen afbeelding beschikbaar</p>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>

    <?php include('includes/footer.php'); ?>
</body>
</html>
