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

                <button class="editBtn" data-id="<?= $kamer['kamersID'] ?>"
                    data-naam="<?= htmlspecialchars($kamer['kamerNaam']) ?>"
                    data-beschrijving="<?= htmlspecialchars($kamer['kamerBeschrijving']) ?>"
                    data-prijs="<?= htmlspecialchars($kamer['prijs']) ?>">
                    Bewerken
                </button>

            </section>
        <?php endforeach; ?>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bewerkKamer'])) {
            $kamerID = $_POST['kamersID'];
            $kamerNaam = $_POST['kamerNaam'];
            $kamerBeschrijving = $_POST['kamerBeschrijving'];
            $prijs = $_POST['prijs'];
            $kamerFoto = isset($_FILES['kamerFoto']) ? $_FILES['kamerFoto'] : null;

            $resultaat = kamerBewerken($conn, $kamerID, $kamerNaam, $kamerBeschrijving, $prijs, $kamerFoto);
            echo "<p>$resultaat</p>";

            // Redirect om herladen te voorkomen
            header("Location: kamers.php");
        }


        ?>


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

                    <input type="file" name="kamerFoto">

                    <input type="submit" value="Toevoegen" name="verstuur">
                </form>
            </article>
        </section>

        <?php
        // Functie voor toevoegen oproepen NA het formulier
        kamerToevoegen($conn);
        ?>
        <!-- Modal voor het bewerken van een kamer -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Kamer bewerken</h2>
                <form id="editForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="editKamerID" name="kamersID">

                    <label for="editKamerNaam">Kamernaam:</label>
                    <input type="text" id="editKamerNaam" name="kamerNaam" required>

                    <label for="editKamerBeschrijving">Kamer beschrijving:</label>
                    <textarea id="editKamerBeschrijving" name="kamerBeschrijving" required></textarea>

                    <label for="editPrijs">Prijs:</label>
                    <input type="number" step="0.01" id="editPrijs" name="prijs" required>

                    <label for="editKamerFoto">Nieuwe foto (optioneel):</label>
                    <input type="file" id="editKamerFoto" name="kamerFoto">

                    <input type="submit" name="bewerkKamer" value="Bijwerken">
                </form>
            </div>
        </div>

    </main>

    <?php include('includes/footer.php'); ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("editModal");
            const closeBtn = document.querySelector(".close");
            const editForm = document.getElementById("editForm");

            document.querySelectorAll(".editBtn").forEach(button => {
                button.addEventListener("click", function () {
                    document.getElementById("editKamerID").value = this.getAttribute("data-id");
                    document.getElementById("editKamerNaam").value = this.getAttribute("data-naam");
                    document.getElementById("editKamerBeschrijving").value = this.getAttribute("data-beschrijving");
                    document.getElementById("editPrijs").value = this.getAttribute("data-prijs");
                    modal.style.display = "block";
                });
            });

            closeBtn.addEventListener("click", function () {
                modal.style.display = "none";
            });

            window.addEventListener("click", function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
        });
    </script>

</body>

</html>