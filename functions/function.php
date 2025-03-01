<?php


function dbConnect()
{
    //mysql gegevens
    $servername = "localhost";
    $database = "hotel";
    $dsn = "mysql:host=$servername;dbname=$database";
    $gebruikername = "root";
    $wachtwoord = "";
    //database aanmaken met pdo functie
    $conn = new PDO($dsn, $gebruikername, $wachtwoord);
    //geeft de connectie terug
    return $conn;
}

function login($conn)
{
    // kijkt of de submit knop is ingeklikt
    if (isset($_POST['submit'])) {

        // kijkt of de name en wachtwoord zijn ingevuld en daarna vult hij ze in variabelen
        if (isset($_POST['name']) && isset($_POST['password'])) {
            $name = $_POST['name'];
            $wachtwoord = $_POST['password'];

            // try catch voor pdo
            try {
                $stmt = $conn->prepare("SELECT * FROM admin WHERE name = :name");
                $stmt->bindParam(':name', $name);
                $stmt->execute();
                $name = $stmt->fetch(PDO::FETCH_ASSOC);

                // als die de gebruiker kan ophalen uit de database en als de statement niet false is dan voert die de volgende code uit
                if ($name !== false) {

                    // kijkt of het wachtwoord gelijk is als het wachtwoord in de database
                    if (password_verify($wachtwoord, $name['password'])) {
                        echo "Wachtwoord klopt";

                        // Start de sessie en sla e-mail op
                        $_SESSION['name'] = $name['name'];

                        // Redirect naar index.php na succesvolle login, header functie werkte niet
                        echo "<script>window.location.href='index.php';</script>";
                        exit();
                    } else {
                        echo "Verkeerd wachtwoord";
                    }
                } else {
                    echo "Gebruiker niet gevonden";
                }
            } catch (PDOException $e) {
                echo "Fout: " . $e->getMessage();
            }
        } else {
            echo "name en wachtwoord moeten worden ingevuld";
        }
    }
}

function kamerToevoegen($conn)
{
    if (isset($_POST['verstuur'])) {
        $kamerNaam = $_POST['kamerNaam'];
        $kamerBeschrijving = $_POST['kamerBeschrijving'];
        $prijs = $_POST['prijs'];
        $targetDir = "uploads/";
        $kamerFoto = null;

        // Check of er een bestand is geüpload
        if (!empty($_FILES["kamerFoto"]["name"])) {
            print_r($_FILES["kamerFoto"]); // Debug output

            $fileName = basename($_FILES["kamerFoto"]["name"]);
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = uniqid() . "." . $fileType;
            $targetFilePath = $targetDir . $newFileName;

            $allowedTypes = ["jpg", "jpeg", "png"];

            if (in_array($fileType, $allowedTypes)) {
                // Controleer of uploads map bestaat
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                // Controleer fouten bij uploaden
                if ($_FILES["kamerFoto"]["error"] !== UPLOAD_ERR_OK) {
                    echo "Fout bij uploaden: " . $_FILES["kamerFoto"]["error"];
                    return;
                }

                // Probeer bestand te verplaatsen
                if (move_uploaded_file($_FILES["kamerFoto"]["tmp_name"], $targetFilePath)) {
                    echo "Upload succesvol! Bestand opgeslagen als: " . $targetFilePath;
                    $kamerFoto = $newFileName;
                } else {
                    echo "Upload mislukt! Controleer bestandsrechten.";
                    return;
                }
            } else {
                echo "Ongeldig bestandstype. Alleen JPG, JPEG, PNG en GIF zijn toegestaan.";
                return;
            }
        }

        // Probeer gegevens op te slaan in de database
        try {
            $stmtUpdate = $conn->prepare("INSERT INTO `kamers` (`kamerNaam`, `kamerBeschrijving`, `prijs`, `kamerFoto`) 
                                          VALUES (:kamerNaam, :kamerBeschrijving, :prijs, :kamerFoto)");

            $stmtUpdate->bindParam(':kamerNaam', $kamerNaam);
            $stmtUpdate->bindParam(':kamerBeschrijving', $kamerBeschrijving);
            $stmtUpdate->bindParam(':prijs', $prijs);
            $stmtUpdate->bindParam(':kamerFoto', $kamerFoto);

            if ($stmtUpdate->execute()) {
                echo "<script type=\"text/javascript\">toastr.success('Kamer succesvol toegevoegd!')</script>";
                exit();
            } else {
                echo "Er ging iets mis bij het toevoegen van de kamer.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}



function kamerverwijderen($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verwijderKamer'])) {
        $kamer_id = $_POST['kamersID'];

        // Stap 1: Haal de bestandsnaam op uit de database
        $stmt = $conn->prepare("SELECT kamerFoto FROM kamers WHERE kamersID = :kamersID");
        $stmt->bindParam(':kamersID', $kamer_id, PDO::PARAM_INT);
        $stmt->execute();
        $kamer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($kamer && !empty($kamer['kamerFoto'])) {
            $fotoPath = "uploads/" . $kamer['kamerFoto'];

            // Stap 2: Controleer of het bestand bestaat en verwijder het
            if (file_exists($fotoPath)) {
                unlink($fotoPath); // Verwijder het bestand
            }
        }

        // Stap 3: Verwijder de database-entry
        $query = "DELETE FROM kamers WHERE kamersID = :kamersID";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':kamersID', $kamer_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: kameraanpassen.php"); // Terug naar de lijst na verwijderen
            exit();
        } else {
            echo "Fout bij verwijderen.";
        }
    }
}



function kamerBewerken($conn, $kamerID, $kamerNaam, $kamerBeschrijving, $prijs, $kamerFoto = null) {
    // Check of er een nieuwe foto is geüpload
    if ($kamerFoto && $kamerFoto['error'] == 0) {
        $fotoNaam = basename($kamerFoto['name']); // Krijg de naam van de foto
        $uploadPad = 'uploads/' . $fotoNaam; // Het volledige pad naar de uploadmap

        // Verplaats de foto naar de juiste map
        if (move_uploaded_file($kamerFoto['tmp_name'], $uploadPad)) {
            // Als de upload succesvol is, werk dan de foto in de database bij
            $query = "UPDATE kamers SET kamerNaam = :kamerNaam, kamerBeschrijving = :kamerBeschrijving, prijs = :prijs, kamerFoto = :kamerFoto WHERE kamersID = :kamersID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':kamerNaam', $kamerNaam, PDO::PARAM_STR);
            $stmt->bindParam(':kamerBeschrijving', $kamerBeschrijving, PDO::PARAM_STR);
            $stmt->bindParam(':prijs', $prijs, PDO::PARAM_STR);
            $stmt->bindParam(':kamerFoto', $fotoNaam, PDO::PARAM_STR); // Sla alleen de bestandsnaam op
            $stmt->bindParam(':kamersID', $kamerID, PDO::PARAM_INT);

            return $stmt->execute() ? 'Kamer succesvol bijgewerkt' : 'Er is een fout opgetreden bij het bijwerken van de kamer';
        } else {
            return 'Er is een fout opgetreden bij het uploaden van de foto';
        }
    } else {
        // Als er geen nieuwe foto is geüpload, werk dan alleen andere velden bij
        $query = "UPDATE kamers SET kamerNaam = :kamerNaam, kamerBeschrijving = :kamerBeschrijving, prijs = :prijs WHERE kamersID = :kamersID";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':kamerNaam', $kamerNaam, PDO::PARAM_STR);
        $stmt->bindParam(':kamerBeschrijving', $kamerBeschrijving, PDO::PARAM_STR);
        $stmt->bindParam(':prijs', $prijs, PDO::PARAM_STR);
        $stmt->bindParam(':kamersID', $kamerID, PDO::PARAM_INT);

        return $stmt->execute() ? 'Kamer succesvol bijgewerkt' : 'Er is een fout opgetreden bij het bijwerken van de kamer';
    }
}



