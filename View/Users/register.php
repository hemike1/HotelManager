<?php
    $db = new Database();
    $register = new User($db);
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Assets/css/login.css">
</head>
<body>
<div class="background-image"></div>
<div>
    <div class="panel">
        <div>
            <div class="title">
                <h1>Regisztráljon!</h1>
            </div>
            <div class="content">
                <form action="" method="POST">
                    <input type="text" name="firstname" placeholder="Keresztnév" required><br>
                    <input type="text" name="lastname" placeholder="Családnév" required><br>
                    <input type="email" name="email" placeholder="E-Mail" reqired><br>
                    <input type="password" name="password" placeholder="Jelszó" required><br>
                    <input type="submit" value="Regisztrálás" class="buttons">
                    <a href="/">Vissza</a>
                </form>
                <?php

                    $sql = 'SELECT registeredEmail FROM '.$GLOBALS['prefix'].'registered WHERE registeredEmail = '.$_POST['email'];
                    $result = $db->dbQuery($sql);
                    if(num_rows($result)>0){
                        echo 'Email address already in use!';
                    } else {
                        if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])){
                            $firstname = $_POST['firstname'];
                            $lastname = $_POST['lastname'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];


                            $sql = 'INSERT INTO '.$GLOBALS['prefix'].'registered(registeredId, registeredFirstName, registeredLastName, registeredEmail, registeredPassword, registeredPermission) VALUES 
                            (null, '.$firstname.', '.$lastname.', '.$email.', '.$password.', 1)';

                            if($db->dbQuery($sql)){
                                echo 'Registration successful';
                            } else {
                                echo 'There was an error in the registration. Check your credentials!';
                            }
                        }
                    }
                    print_r ($_POST);
                ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>