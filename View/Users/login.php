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
                <h1>Üdvözöljük!</h1>
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
                    echo '<button href="/korondi/home">Folytatás</button>';
                }

			    if(isset($_POST['email']) && isset($_POST['password'])) {
			    	$login = $login->checkLogin($_POST['email'], $_POST['password']);
                    print_r($_SESSION);
                    switch($login){
                        case 0:
                            echo 'Nincs ilyen email';
                            break;
                        case 1:
                            echo 'Sikertelen belépés';
                            break;
                        case 2:
                            echo 'Sikeres bejelentkezés';
                            break;
                    }
			    }

            ?>
            </div>
        </div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <?php require_once './layout/footer.php';?>
</body>
