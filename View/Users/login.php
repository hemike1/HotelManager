<?php
    require_once 'Model/User.php';
    require_once 'Model/Database.php';
    $db = new Database();
    $login = new User($db);
    $title = "Bejelentkezés";
?>
<body>
    <div class="background-image"></div>
        <div class="panel">
            <div class="title">
                <?php
                if(isset($_SESSION['name'])){
                    echo '<h1>Üdvözöljük, '.$_SESSION['name'].'!</h1>
                          <p>Nem magát látja?<a></a></p>';
                } else {
                    echo '<h1>Üdvözöljük!</h1>';
                }
                ?>
            </div>
            <div class="content">
            <?php
                if(!isset($_SESSION["name"])) {
                    echo '<form action="" method="POST">
                            <input type="email" name="email" placeholder="E-Mail" required><br>
                            <input type="password" name="password" placeholder="Jelszó" required><br>
                            <input type="submit" value="Belépés" class="buttons">
                            <a href="/korondi/register">Regisztrálás</a>
                        </form>';
                } else {
                    echo '<a href="/korondi/home">Folytatás</a>';
                }

            ?>
            </div>
        </div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
