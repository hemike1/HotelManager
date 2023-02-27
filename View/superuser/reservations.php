<div class="m-3 ms-5 ">
    <div>
        <!--buttons-->
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Keresztnév</th>
                    <th scope="col">Vezetéknév</th>
                    <th scope="col">Email</th>
                    <th scope="col">Szoba szám</th>
                    <th scope="col">Kezdet</th>
                    <th scope="col">Vég</th>
                    <th scope="col">Fizetendő</th>
                    <th scope="col">Fizetve</th>
                    <th scope="col">Számla Azonosító</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //keresztne, veznev, email, szobaszam, kezdet, veg, fizetendo, fizetve, szamla azon
                $sql = $this->prepare('SELECT reservationStartingT, reservationEndT, registeredFirstName, registeredLastName, registeredEmail, roomFloor, roomNumber, invoicePrePaid, invoiceId FROM '.$GLOBALS['prefix'].'reservations INNER JOIN '.$GLOBALS['prefix'].'registered ON reservationRegisteredId = registeredId INNER JOIN '.$GLOBALS['prefix'].'rooms ON reservationRoomId = roomId INNER JOIN '.$GLOBALS['prefix'].'invoice ON reservationId = invoiceReservId WHERE reservationEndT >= '.date("Y-m-d").';');
                    $sql->execute();
                    if($result = $sql->get_result()){
                        if($result->num_rows > 0){
                            while($result = $sql->fetch_assoc()){
                                print_r($result);
                                echo '
                                    <tr>
                                        <td>'.$result['registeredFirstName'].'</td>
                                        <td>'.$result['registeredLastname'].'</td>
                                        <td>'.$result['registeredEmail'].'</td>
                                        <td>'.$result['roomFloor'],$result['roomNumber'].'</td>
                                        <td>'.$result['reservationStartingT'].'</td>
                                        <td>'.$result['reservationEndT'].'</td>
                                        <td>Calculus TBD</td>
                                        <td>'.$result['invoicePrePaid'].'</td>
                                        <td>'.$result['invoiceId'].'</td>
                                    </tr>
                                ';
                            }
                        } else {
                            echo '<td colspan="10" class="text-center">A tábla üres. Még nem érkezett foglalás</td>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>