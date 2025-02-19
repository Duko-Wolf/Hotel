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
    ?>
    <main>
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