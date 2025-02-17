<?php

function registreer($conn)
{
    // kijkt of de knop is ingeklit en daarna vult nieuwe variabelen met waardes van de input velden
    if (isset($_POST['submit'])) {
        $kamerNaam = $_POST['kamerNaam'];
        $kamerBeschrijving = $_POST['kamerBeschrijving'];
        $prijs = $_POST['prijs'];

        // try catch voor pdo zodat hij niet crasht
        try {
            // zet statement klaar en bind de variabelen aan de values van de statement
            $stmtUpdate = $conn->prepare("INSERT INTO `gebruikers` (`kamerNaam`, `kamerBeschrijving`, `prijs`) 
            VALUES (:kamerNaam, :kamerBeschrijving, :prijs)");

            $stmtUpdate->bindParam(':kamerNaam', $kamerNaam);
            $stmtUpdate->bindParam(':kamerBeschrijving', $kamerBeschrijving);
            $stmtUpdate->bindParam(':prijs', $prijs);

            // kijkt of het wachtwoord en herhaal wachtwoord het zelfde zijn
            if ($stmtUpdate->execute()) {
                echo "<script type=\"text/javascript\">toastr.success('registered successfully!')</script>";
                exit();
            } else {
                echo "er ging iets mis";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}