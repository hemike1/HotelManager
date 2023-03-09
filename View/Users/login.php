<?php
    require_once 'Model/User.php';
    require_once 'Model/Database.php';
    $db = new Database();
    $login = new User($db);
    $title = "Bejelentkezés";
?>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-12 col-sm-12 col-md-10 col-lg-5">
            <div class="card">
                <div class="card-header text-center bg-custom text-white">
                    <h2 class="my-1">Üdvözöljük!</h2>
                </div>
                <div class="card-body text-center">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <span for="email" class="input-group-text"><i class="fa-solid fa-at"></i></span>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required placeholder="Email címed">
                            <span class="error invalid-feedback"><?php ?></span>
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
<?php
//print_r($error_password);
 if(!empty($error_password) || !empty($error_email)){ //got this snippet from tokrist, with thge help of sweetalert2. ?>
    <script>
        setTimeout(function (){
            Swal.fire({
                icon: 'error',
                title: 'Hibás adatok!',
                text: "<?php if(!empty($error_email)) echo $error_email; if(!empty($error_password)) echo $error_password; ?>",
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true
            })
        }, 100);
    </script>
<?php } ?>