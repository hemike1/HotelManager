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
                $sql = $this->prepare('SELECT reservationStartingT, reservationEndT, registeredFirstName, registeredLastName, registeredEmail, roomFloor, roomNumber, invoicePrePaid, invoiceId FROM '.$GLOBALS['prefix'].'reservations INNER JOIN '.$GLOBALS['prefix'].'registered ON reservationRegisteredId = registeredId INNER JOIN '.$GLOBALS['prefix'].'rooms ON reservationRoomId = roomId INNER JOIN '.$GLOBALS['prefix'].'invoice ON reservationId = invoiceReservId WHERE reservationEndT >= CURDATE();');
                $sql->execute();
                if($result = $sql->get_result()){
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
							if($row['invoicePrePaid'] == 1){
                                $fizetve = 'Igen';
                            } else {
                                $fizetve = 'Nem';
                            };
                            echo '
                                <tr>
                                    <td>'.$db->decryptData($row['registeredFirstName']).'</td>
                                    <td>'.$db->decryptData($row['registeredLastName']).'</td>
                                    <td>'.$db->decryptData($row['registeredEmail']).'</td>
                                    <td>'.$row['roomFloor']."-".$row['roomNumber'].'</td>
                                    <td>'.$row['reservationStartingT'].'</td>
                                    <td>'.$row['reservationEndT'].'</td>
                                    <td>Calculus TBD</td>
                                    <td>'.$fizetve.'</td>
                                    <td>'.$row['invoiceId'].'</td>
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