<?php
    require_once 'Model/User.php';
    require_once 'Model/Database.php';
    $db = new Database();
    $login = new User($db);
    $title = "Bejelentkezés";
?>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header text-center bg-custom text-white">
                    <h2 class="my-1">Üdvözöljük!</h2>
                </div>
                <div class="card-body text-center">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <span for="email" class="input-group-text"><i class="fa-solid fa-at"></i></span>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required placeholder="Email címed">
                        </div>

                        <div class="input-group mb-3">
                            <span for="password" class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" required placeholder="Jelszó">
                        </div>
                        <div id="emailHelp" class="form-text mb-3">Soha ne oszd meg az adataid senkivel.</div>
                        <button type="submit" class="btn btn-custom">Bejelentkezés</button>
                        <div class="mt-3">
                            Nincs még felhasználója?&nbsp;<a href="/korondi/register" type="button">Regisztráljon!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
