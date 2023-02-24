<head>
    <link type="text/css" rel="stylesheet" href="http://banki13.komarom.net/korondi/Assets/css/404.css"/>
    <title>Kérés elutasítva</title>
</head>
<body>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>
                    4<span>0</span>3
                </h1>
            </div>
            <p>Nem rendelkezik a megfelelő jogosultságokkal a belépéshez!</p>
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