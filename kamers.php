<?php include('includes/session.php') ?>
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
    <h1>Beschikbare Kamers</h1>

    <?php foreach ($kamers as $kamer): ?>
        <section class="kamer">
            <h2><?= htmlspecialchars($kamer['kamerNaam']) ?></h2>
            <p><?= htmlspecialchars($kamer['kamerBeschrijving']) ?></p>
            <p class="prijs">Prijs per nacht: €<?= htmlspecialchars($kamer['prijs']) ?></p>
        </section>
    <?php endforeach; ?>

    <?php include('includes/footer.php'); ?>
</body>
</html>
