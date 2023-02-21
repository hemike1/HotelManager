<?php
    require_once 'Model/User.php';
    require_once 'Model/Database.php';
    $db = new Database();
    $login = new User($db);
    $title = "Bejelentkezés";
?>
    <div class="background-image"> </div>
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
            <div class="mb-3">
            <?php
                if(!isset($_SESSION["name"])) {
                    echo '<form action="" method="POST">
                            <input class="form-control" type="email" name="email" placeholder="E-Mail" required><br>
                            <input class="form-control" type="password" name="password" placeholder="Jelszó" required><br>
                            <input type="submit" value="Belépés" class="buttons">
                            <a href="/korondi/register">Regisztrálás</a>
                        </form>';
                } else {
                    echo '<a href="/korondi/home">Folytatás</a>';
                }
            ?>
            </div>
        </div>
