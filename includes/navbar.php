<nav>
    <a class="logoContainer" href="index.php">
        <img class="logo" src="images/img-logo/logo variant 1.png" alt="">
    </a>

    <a href="kamers.php">Kamers</a>

    <a href="restaurant.php">Restaurant</a>

    <a href="ons.php">Over ons</a>

    <a href="contact.php">Contact</a>

    <?php if (isset($_SESSION['name'])): ?>

    <a href="Kameraanpassen.php">Kamer Aanpassen</a>

    <form method="post">
        <button class="text-light nav-link btn btn-danger" name="Uitlog">Uitlog</button>
    </form>

    <?php
    // al heb je op uitlog gedrukt dan vernietigt hij de sessie email
    if (isset($_POST["Uitlog"])) {
        session_destroy();
        header("Refresh:0");
    }
    ?>
    
    <?php endif; ?>

</nav>