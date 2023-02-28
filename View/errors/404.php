<head>
    <link type="text/css" rel="stylesheet" href="/korondi/Assets/css/404.css"/>
    <title>Nincs ilyen oldal</title>
</head>
<body>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>
                    4<span>0</span>4
                </h1>
            </div>
            <p>A hely amit keres nem elérhető vagy lehet hogy törölték.</p>
            <?php
            if (isset($_SESSION['id'])) {
                echo '<a href="/korondi/home">Vissza</a>';
            } else {
                echo '<a href="/korondi/">Bejelentkezés</a>';
            }
            ?>
        </div>
    </div>
</body>
