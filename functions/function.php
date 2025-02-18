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
    // kijkt of de knop is ingeklit en daarna vult nieuwe variabelen met waardes van de input velden
    if (isset($_POST['verstuur'])) {
        $kamerNaam = $_POST['kamerNaam'];
        $kamerBeschrijving = $_POST['kamerBeschrijving'];
        $prijs = $_POST['prijs'];

        // try catch voor pdo zodat hij niet crasht
        try {
            // zet statement klaar en bind de variabelen aan de values van de statement
            $stmtUpdate = $conn->prepare("INSERT INTO `kamers` (`kamerNaam`, `kamerBeschrijving`, `prijs`) 
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