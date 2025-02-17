<nav>
    <link rel="stylesheet" href="reset/nav.css" />
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
            echo '<li>
            
        
                    ';

                    echo'<a href="kameraanpassen.php">Het Weer</a>';
                    echo '</li>';
        }
        ?>

    </ul>
</nav>