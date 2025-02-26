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
    <link rel="stylesheet" href="styling/global.css" />
    <title>Kamers Overzicht</title>
</head>

<body>
    <?php include('includes/navbar.php'); ?>
    <?php include('includes/header.php'); ?>

    <?php foreach ($kamers as $kamer): ?>
        <section id="flexcontainter">
            <h2 class="titleitem"><?= htmlspecialchars($kamer['kamerNaam']) ?></h2>
            <article class="flex-itemr">
                <?php if (!empty($kamer['kamerFoto'])): ?>
                    <img src="uploads/<?= htmlspecialchars($kamer['kamerFoto']) ?>" alt="Kamer foto" class="menu-img">
                <?php else: ?>
                    <p>Geen afbeelding beschikbaar</p>
                <?php endif; ?>
                <p class="flex-text">
                    <?= htmlspecialchars($kamer['kamerBeschrijving']) ?>
                    
                </p>
                <p class="flex-text"><?= number_format(htmlspecialchars($kamer['prijs']), 2, ',', '.') ?></p>
            </article>
        </section>
    <?php endforeach; ?>

    <?php include('includes/footer.php'); ?>
</body>

</html>




<!-- <section class="flexcontainter">
            <h2 class="titleitem"></h2>
            <article class="flex-itemr">
                <p class="flex-text"></p>
                <p class="flex-text">Prijs per nacht: €>
                </p>


                </article>

</section> -->