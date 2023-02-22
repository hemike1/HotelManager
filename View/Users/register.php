<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header text-center bg-custom text-white">
                    <h2 class="my-1">Regisztrálás</h2>
                </div>
                <div class="card-body text-center">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-signature"></i></span>
                            <input type="text" aria-label="" name="firstname" class="form-control" placeholder="Vezetéknév" required>
                            <input type="text" aria-label="" name="lastname" class="form-control" placeholder="Keresztnév" required>
                        </div>
                        <div class="input-group mb-3">
                            <span for="email" class="input-group-text"><i class="fa-solid fa-at"></i></span>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required placeholder="Email címed">
                        </div>
                        <div class="input-group mb-3">
                            <span for="password" class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" required placeholder="Jelszó">
                        </div>
                        <button type="submit" class="btn btn-custom">Regisztrálás</button>
                        <div class="mt-3">
                            Már van felhasználója?&nbsp;<a href="/korondi/login" type="button">Jelentkezzen be!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>