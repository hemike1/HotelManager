<div class="container-fluid "> <!-- Sidebar from codeply, then edited to fit https://www.codeply.com/p/WGCqYEiPBg -->
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-color-custom text-decoration-none">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 ">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline"><img src="/korondi/Assets/images/HotelLogo.png" height="45"></span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start fs-5" id="menu">
                    <li class="nav-item">
                        <a href="/korondi/home" class="nav-link align-middle px-0">
                            <i class="fa-regular fa-house color-custom"></i> <span class="ms-1 d-none d-sm-inline color-custom">Főoldal</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/korondi/reservation" class="nav-link align-middle px-0">
                            <i class="fa-regular fa-book-open-cover color-custom"></i> <span class="ms-1 d-none d-sm-inline color-custom">Szoba foglalás</span>
                        </a>
                    </li>
                    <li>
                        <a href="/korondi/review" class="nav-link px-0 align-middle">
                            <i class="fa-regular fa-star color-custom"></i> <span class="ms-1 d-none d-sm-inline color-custom">Értékeljen</span></a>
                    </li>
                    <li>
                        <a href="/korondi/contacts" class="nav-link px-0 align-middle">
                            <i class="fa-regular fa-circle-phone color-custom"></i> <span class="ms-1 d-none d-sm-inline color-custom">Elérhetőségek</span> </a>
                    </li>
                    <li>
                        <a href="/korondi/access" class="nav-link px-0 align-middle">
                            <i class="fa-regular fa-wheelchair color-custom"></i> <span class="ms-1 d-none d-sm-inline color-custom">Akadálymentesítés</span> </a>
                    </li>
                    <li>
                        <a href="/korondi/images" class="nav-link px-0 align-middle pb-5">
                            <i class="fa-regular fa-image color-custom"></i> <span class="ms-1 d-none d-sm-inline color-custom">Képeink</span> </a>
                    </li>
					<?php if($user->getPermission() >= 2): ?>
                        <li>
                            <a href="/korondi/bookie/reservations" class="nav-link px-0 align-middle">
                                <i class="fa-regular fa-book-arrow-right color-custom"></i> <span class="ms-1 d-none d-sm-inline color-custom">Foglalások</span> </a>
                        </li>
					<?php endif; if($user->getPermission() == 3): ?>
                        <li>
                            <a href="/korondi/admin/allreserv" class="nav-link px-0 align-middle">
                                <i class="fa-regular fa-receipt color-custom"></i> <span class="ms-1 d-none d-sm-inline color-custom">Összes foglalás</span> </a>
                        </li>
                        <li>
                            <a href="/korondi/admin/usermgmt" class="nav-link px-0 align-middle">
                                <i class="fa-regular fa-users color-custom"></i> <span class="ms-1 d-none d-sm-inline color-custom">Recepciós Felvétel</span> </a>
                        </li>
                        <li>
                            <a href="/korondi/admin/newroom" class="nav-link px-0 align-middle">
                                <i class="fa-regular fa-plus color-custom"></i> <span class="ms-1 d-none d-sm-inline color-custom">Új szoba rögzítése</span> </a>
                        </li>
					<?php endif; ?>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-none d-sm-inline mx-1"><?php
                             if($user->getPermission() == 1){
                                 echo '<i class="fa-light fa-user"></i>';
                             } else if($user->getPermission() == 2) {
                                 echo '<i class="fa-regular fa-book-open-cover"></i>';
                             }
                             else if($user->getPermission() == 3) {
                                 echo '<i class="fa-regular fa-star"></i>';
                             }
                             print_r(" ".$user->getFirstName() ." ". $user->getLastName());?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/korondi/logout">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">