<?php include('includes/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/global.css" />
    <title>Contact</title>
</head>

<body>
    <?php include('includes/navbar.php'); ?>
    <?php include('includes/header.php');

    include("functions/function.php");

    $conn = dbConnect();

    if (!isset($_SESSION['name'])) {
        header("Location: index.php");
        exit();
    }

    $query = "SELECT * FROM kamers";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $kamers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <main>
        <?php foreach ($kamers as $kamer): ?>
            <section class="kamer">
                <h2><?= htmlspecialchars($kamer['kamerNaam']) ?></h2>
                <p><?= htmlspecialchars($kamer['kamerBeschrijving']) ?></p>
                <p class="prijs">Prijs per nacht: €<?= htmlspecialchars($kamer['prijs']) ?></p>
                <form method="post" action="#">
                    <input type="hidden" name="kamersID" value="<?= $kamer['kamersID'] ?>">
                    <button type="submit" onclick="return confirm('Weet je zeker dat je deze kamer wilt verwijderen?');">
                        Verwijderen
                    </button>
                </form>
            </section>
        <?php endforeach; ?>

        <section>
            <article>
                <h2>Contactformulier</h2>
                <form action="#" method="post" enctype="multipart/form-data">
                    <label for="name">Kamernaam:</label>
                    <input type="text" id="name" name="kamerNaam" required>

                    <label for="email">Kamer beschrijving:</label>
                    <input type="text" id="email" name="kamerBeschrijving" required>

                    <input type="file" name="fileToUpload" id="fileToUpload">

                    <label for="question">Prijs:</label>
                    <input type="text" name="prijs"></textarea>

                    <input type="submit" value="verstuur" name="verstuur">
                </form>
            </article>
        </section>


        <?php
        require_once 'functions/function.php';
        $conn = dbConnect();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kamersID'])) {
            $kamer_id = $_POST['kamersID'];

            $query = "DELETE FROM kamers WHERE kamersID = :kamersID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':kamersID', $kamer_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("Location: kameraanpassen.php"); // Terug naar de lijst na verwijderen
                exit();
            } else {
                echo "Fout bij verwijderen.";
            }
        } else {
            echo "werkt niet";
            exit();
        }
        ?>


        <?php
        // import functions.php
        require_once 'functions\function.php';

        $conn = dbConnect();

        // use function login() from functions.php
        kamerToevoegen($conn);

        ?>
    </main>





    <?php include('includes/footer.php'); ?>
</body>

</html>