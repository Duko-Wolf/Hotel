<nav>
    <link rel="stylesheet" href="styling/nav.css" />
    <link rel="stylesheet" href="styling/nav.css" />
    <ul>
        <li>
            <a class="logoContainer" href="index.php">
                <img class="logo" src="images/img-logo/logo.png" alt="">
            </a>
        </li>

        <li>
            <a href="kamers.php">Kamers</a>
        </li>

        <li>
            <a href="restaurant.php">Restaurant</a>
        </li>

        <li>
            <a href="ons.php">Over ons</a>
        </li>

        <li>
            <a href="contact.php">Contact</a>
        </li>

        <!--<li>
            <a href="weer.php">Het Weer</a>
        </li> -->

        <?php
        if (isset($_SESSION['name'])) {
            //uitlog
            echo '<li>';
            echo '<a href="kameraanpassen.php">Kamer Aanpassen</a>';
            echo '</li>';

            echo '
                    <form method="post">
                        <button class=" text-light nav-link btn btn-danger" name="Uitlog">Uitlog</button>
                    </form>
                    ';
                    // al heb je op uitlog gedrukt dan vernietigt hij de sessie email
                    if (isset($_POST["Uitlog"])) {
                        session_destroy();
                        header("Refresh:0");
                    }
        }
        ?>

    </ul>
</nav>