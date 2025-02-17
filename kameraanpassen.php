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


    <main>
        <section>
            <article> <br>
                <h2>Contactformulier</h2>
                <form action="#" method="post">
                    <label for="name">kamernaam</label><br>
                    <input type="text" id="name" name="name" required><br><br>

                    <label for="email">kamer beschrijving</label><br>
                    <input type="email" id="email" name="email" required><br><br>

                    <label for="question">prijs</label><br>
                    <textarea id="question" name="question" rows="1" required></textarea><br><br>

                    <input type="submit" value="Verstuur">
                </form>
            </article>
        </section>

        <section>
            <article> <br>
                <h2>Contactgegevens</h2>
                <p>Telefoonnummer: +31 123 456 789</p>
                <p>Adres: Straatnaam 85, 1234 AB Alkmaar</p>
                <p>Email: info@hotelzonnevallei.nl</p>
            </article>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>
</body>

</html>