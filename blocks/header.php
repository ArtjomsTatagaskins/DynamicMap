<header>
    <div class="web-name"><a href="/mainpage.php"><h3>Interaktīvā karte</h3></a></div>
    <div class="dropdown-list">

        <?php
        if(isset($_COOKIE['login'])) {
            echo '<a href="/user.php">Personīgais konts</a>';
            if (basename($_SERVER['PHP_SELF']) == 'user.php') {
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
