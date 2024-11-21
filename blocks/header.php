<header>
    <div class="web-name"><a href="/mainpage.php"><h3>Interaktīvā karte</h3></a></div>
    <div class="link-list">

        <?php
        if (isset($_COOKIE['login'])) {
            if (basename($_SERVER['PHP_SELF']) != 'user.php') {
                echo '<a href="/user.php">Personīgais konts</a>';
            } else {
                echo '
            <form action="/lib/logout.php" method="post">
                <button type="submit" class="logout-button">Iziet no sistēmas</button>
            </form>';
            }
        } else {
            echo '<a href="/authorization.php">Reģistrācija/Ieiešana</a>';
        }
        ?>
    </div>
</header>
