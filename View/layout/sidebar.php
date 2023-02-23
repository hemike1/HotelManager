<div class="d-flex flex-column flex-shrink-0 bg-light sidebar position-fixed bg-color-custom" style="height: 100vh;">
    <a href="/korondi/home" class="d-block p-1 link-dark text-decoration-none text-center border-bottom border-5" title="Főoldal" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Főoldal">
        <image class="bi" width="35" src="Assets/images/HotelLogo.png" title="Logo" alt="Logo"></image>
    </a>
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        <li>
            <a href="/korondi/home" class="nav-link py-3 border-bottom" title="Főoldal" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Főoldal">
                <i class="fa-regular fa-house icon-color-custom"></i>
            </a>
        </li>
        <li>
            <a href="/korondi/review" class="nav-link py-3 border-bottom" title="Értékeljen minket!" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Értékeljen minket!">
                <i class="fa-regular fa-star icon-color-custom"></i>
            </a>
        </li>
        <li>
            <a href="/korondi/contacts" class="nav-link py-3 border-bottom" title="Elérhetőségek" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Elérhetőségek">
                <i class="fa-regular fa-circle-phone icon-color-custom"></i>
            </a>
        </li>
        <li>
            <a href="/korondi/info" class="nav-link py-3 border-bottom" title="Akadálymentesítés" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Akadálymentesítés">
                <i class="fa-regular fa-wheelchair icon-color-custom"></i>
            </a>
        </li>
        <li>
            <a href="/korondi/images" class="nav-link py-3 border-bottom border-5" title="Képeink" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Képeink">
                <i class="fa-regular fa-image icon-color-custom"></i>
            </a>
        </li>
        <?php if($user->getPermission() >= 2): ?>
        <li>
            <a href="/korondi/reservations" class="nav-link py-3 border-bottom" title="Foglalások" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Foglalások">
                <i class="fa-regular fa-file icon-color-custom"></i>
            </a>
        </li>
        <?php endif; if($user->getPermission() == 3): ?>
        <li>
            <a href="/korondi/admin/allreserv" class="nav-link py-3 border-bottom" title="Összes foglalás" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Összes foglalás">
                <i class="fa-regular fa-file icon-color-custom"></i>
            </a>
        </li>
        <li>
            <a href="/korondi/admin/usermgmt" class="nav-link py-3 border-bottom border-5" title="Recepciós felvétel" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Recepciós felvétel">
                <i class="fa-regular fa-file icon-color-custom"></i>
            </a>
        </li>
        <?php endif; ?>
    </ul>
    <div class="dropdown border-top">
        <a class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle show" data-bs-toggle="dropdown">
            <i class="fa-regular fa-user"></i>
        </a>
        <ul class="dropdown-menu text-small shadow">
            <li>
                <a href="/korondi/myprofile" class="dropdown-item"><?php echo $user->getLastname()." ".$user->getFirstname();?></a>
            </li>
            <li>
                <a href="/korondi/myreservations" class="dropdown-item">Foglalásaim</a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a href="/korondi/logout" class="dropdown-item">Kijelentkezés</a>
            </li>
        </ul>
    </div>
</div>