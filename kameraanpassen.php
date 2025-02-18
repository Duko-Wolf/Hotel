<?php include('includes/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/index.css" />
    <title>Contact</title>
</head>

<body>
    <?php include('includes/navbar.php'); ?>
    <?php include('includes/header.php'); ?>


    ?>
    <main>
        <section>
            <article> 
                <h2>Contactformulier</h2>
                <form action="kameraanpassen.php" method="post" enctype="multipart/form-data">
                    <label for="name">Kamernaam:</label><br>
                    <input type="text" id="name" name="kamerNaam" required><br><br>

                    <label for="email">Kamer beschrijving:</label><br>
                    <input type="text" id="email" name="kamerBeschrijving" required><br><br>

                    <input type="file" name="fileToUpload" id="fileToUpload"><br>

                    <label for="question">Prijs:</label><br>
                    <input type="text" name="prijs"></textarea><br><br>

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