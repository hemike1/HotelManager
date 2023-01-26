<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
</head>
<body>
        <div class="sidebar">
            <button>M</button>
            <div class="nobreak">
                <nobr>
                    <a href="#" style="white-space: pre"><i class="fa-regular fa-house"></i>&#9;Home</a><br>
                    <a href="#" style="white-space: pre"><i class="fa-regular fa-book"></i>&#9;Reservation</a><br>
                    <a href="#" style="white-space: pre"><i class="fa-regular fa-location-question"></i>&#9;Services</a><br>
                    <a href="#" style="white-space: pre"><i class="fa-regular fa-star"></i>&#9;Leave a review</a><br>
                    <a href="#" style="white-space: pre"><i class="fa-regular fa-right-to-bracket"></i>&#9;Log-In</a>
                </nobr>
            </div>
        </div>
    <script src="../../assets/js/fontawesome.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous">

    </script>
    <script>
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        document.querySelector('button').onclick = function() {
            sidebar.classList.toggle('sidebar_small');
            mainContent.classList.toggle('main-content_large');
        }

    </script>
</body>