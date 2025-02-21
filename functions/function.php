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
        $targetDir = "uploads/"; // Folder voor foto's
        $kamerFoto = null; // Standaard null als er geen foto is

        // Controleer of een bestand is geüpload
        if (!empty($_FILES["kamerFoto"]["name"])) {
            $fileName = basename($_FILES["kamerFoto"]["name"]);
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = uniqid() . "." . $fileType; // Voorkom naamconflicten
            $targetFilePath = $targetDir . $newFileName;

            $allowedTypes = ["jpg", "jpeg", "png", "gif"];
            if (in_array($fileType, $allowedTypes)) {
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                // Verplaats bestand naar de uploads-map
                if (move_uploaded_file($_FILES["kamerFoto"]["tmp_name"], $targetFilePath)) {
                    $kamerFoto = $newFileName;
                } else {
                    echo "Er ging iets mis bij het uploaden van de foto.";
                    return;
                }
            } else {
                echo "Ongeldig bestandstype. Alleen JPG, JPEG, PNG en GIF zijn toegestaan.";
                return;
            }
        }

        // Probeer de kamer + foto in de database op te slaan
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
}