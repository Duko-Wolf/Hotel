<?php


function dbConnect()
{
    //mysql gegevens
    $servername = "localhost";
    $database = "hotel";
    $dsn = "mysql:host=$servername;dbname=$database";
    $gebruikername = "bit_academy";
    $wachtwoord = "bit_academy";
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
                $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

                // als die de gebruiker kan ophalen uit de database en als de statement niet false is dan voert die de volgende code uit
                if ($gebruiker !== false) {

                    // kijkt of het wachtwoord gelijk is als het wachtwoord in de database
                    if (password_verify($wachtwoord, $gebruiker['password'])) {
                        echo "Wachtwoord klopt";

                        // Start de sessie en sla e-mail op
                        $_SESSION['name'] = $gebruiker['name'];

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