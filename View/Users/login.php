<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" href="../../Assets/css/login.css">
</head>
<body>
    <div class="background-image"></div>
    <div class="content">
        <div class="panel">
            <div class="maindiv">
                <h1>Üdvözöljük!</h1>
                <?php
                    if(!isset($_SESSION[""])) {
                        echo '<form action="" method="POST">
                                <input type="email" name="email" placeholder="E-Mail" required><br>
                                <input type="password" name="jelszo" placeholder="Jelszó" required><br>
                                <input type="submit" value="Belépés" class="buttons">
                                
                            </form>';
                    } else {
                        echo '<form action="" method="post" enctype="multipart/form-data" style="text-align: center;">
                                Válaszd ki a profilképet amit fel szeretnél tölteni:<br>
                                <input type="file" name="profilkep" id="profilkep">
                                <br><input type="submit" class="buttons" value="Upload Image" name="submit">
                            </form>';
                    }
                ?>

            </div>
        </div>
    </div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
