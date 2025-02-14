<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/index.css"/>
    <title>Contact</title>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/navbar.php'); ?>

    <main>
        

        <section>
            <article> <br>
                <h2>Contactformulier</h2>
                <form action="#" method="post">
                    <label for="name">Naam:</label><br>
                    <input type="text" id="name" name="name" required><br><br>

                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required><br><br>

                    <label for="question">Vraag:</label><br>
                    <textarea id="question" name="question" rows="4" required></textarea><br><br>

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
    <script>
        // WARNING:  Alert message when form is submitted - Will be replaced with actual form handling later
        const form = document.querySelector('form');
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Bedankt voor uw bericht! We nemen zo snel mogelijk contact met u op.');
        });
    </script>
</body>
</html>