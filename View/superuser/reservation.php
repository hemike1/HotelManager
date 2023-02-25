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
                $sql = $this->db->prepare('SELECT '.$GLOBALS['prefix'].'reservation.reservationStartingT,
                                                  '.$GLOBALS['prefix'].'reservation.reservationEndT,
                                                  '.$GLOBALS['prefix'].'registered.registeredFirstName,
                                                  '.$GLOBALS['prefix'].'registered.registeredLastName,
                                                  '.$GLOBALS['prefix'].'registered.registeredEmail,
                                                  '.$GLOBALS['prefix'].'rooms.roomFloor,
                                                  '.$GLOBALS['prefix'].'rooms.roomNumber,
                                                  '.$GLOBALS['prefix'].'invoice.invoicePrePaid,
                                                  '.$GLOBALS['prefix'].'invoice.invoiceId
                                            FROM '.$GLOBALS['prefix'].'reservations
                                            INNER JOIN '.$GLOBALS['prefix'].'registered ON '.$GLOBALS['prefix'].'reservations.reservationRegisteredId = '.$GLOBALS['prefix'].'registered.registeredId
                                            INNER JOIN '.$GLOBALS['prefix'].'rooms ON '.$GLOBALS['prefix'].'reservations.reservationRoomId = '.$GLOBALS['prefix'].'rooms.roomId
                                            INNER JOIN '.$GLOBALS['prefix'].'invoice ON '.$GLOBALS['prefix'].'reservations.reservationId = '.$GLOBALS['prefix'].'invoice.invoiceReservId
                                            WHERE '.$GLOBALS['prefix'].'reservations.reservationRegisteredId = ?;');
                    if($sql->bind_param('i', $_SESSION['id'])){
                        $sql->execute();
                        if($result = $sql->get_results()){
                            $result->fetch_assoc();
                            if($result->num_rows() > 0){
                                foreach($result->num_rows() as $result){
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
                                echo '<td colspan="10">A tábla üres. Még nem érkezett foglalás</td>';
                            }
                        }
                    }


                ?>
            </tbody>
        </table>
    </div>
</div>