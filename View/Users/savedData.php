<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#savedLocations" data-bs-toggle="tab" class="nav-link active">Mentett számlázási adataid</a>
                            </li>
                            <li class="nav-item">
                                <a href="#reservations" data-bs-toggle="tab" class="nav-link">Előző foglalásaid</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="savedLocations">
                                <table class="table table-striped text-center">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Irányító szám</th>
                                        <th scope="col">Település neve</th>
                                        <th scope="col">Közterület neve</th>
                                        <th scopt="col">Házszám</th>
                                        <th scopt="col">Gombok</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($usersSavedLoc as $locInfo) {
                                        echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$locInfo["postNum"].'</td>
                                            <td>'.$locInfo["cityName"].'</td>
                                            <td>'.$locInfo["streetName"].'</td>
                                            <td>'.$locInfo["houseNum"].'</td>
                                            <td><a class="btn btn-danger" id="delLoc" onclick="confirmDel('.$locInfo["locId"].', \''.addslashes($locInfo["postNum"]).'\', \''.addslashes($locInfo["cityName"]).'\', \''.addslashes($locInfo["streetName"]).'\', \''.$locInfo["houseNum"].'\')"><i class="fa-solid fa-trash"></i></a></td>
                                        </tr>';
                                        $i++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="reservations">
                                <table class="table table-striped text-center">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Szoba azonosító</th>
                                        <th scope="col">Foglalás kezdete</th>
                                        <th scope="col">Foglalás vége</th>
                                        <th scopt="col">Gombok</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($usersReserv as $res){
                                        echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$res["roomId"].'</td>
                                            <td>'.$res["startTime"].'</td>
                                            <td>'.$res["endTime"].'</td>
                                            <td><a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#previewModal" onclick="getRoom('.$res["roomId"].')"><i class="fa-regular fa-eye"></i></td>
                                        </tr>';
                                        $i++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- room preview modal -->
<div class="modal fade " id="previewModal" tabindex="-1" aria-labelledby="reservationModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-2">
                    <img src="" id="reservPrewImage" class="card-img-top img-thumbnail">
                    <div class="card-body">
                        <p class="card-text" id="reservPrewDesc"></p>
                    </div>
                    <ul class="list-group list-group-flush text-center mb-2">
                        <li class="list-group-item fs-3" id="reservPrewFeature"></li>
                        <li class="list-group-item fs-5" id="reservPrewPrice"></li>
                        <li class="list-group-item fs-5" id="reservPrewNumbers"></li>
                        <li class="list-group-item fs-5" id="reservPrewAccom"></li>
                        <li class="list-group-item fs-5" id="reservPrewSize"></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Bezárás</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getRoom(roomId){
        $.ajax({
            url: '/korondi/Assets/php/reservRoom.php',
            method: 'POST',
            data: {'roomId': roomId},
            success: function (response){
                var data = JSON.parse(response);
                document.getElementById('reservPrewImage').src = "/korondi/Assets/images/rooms/"+data["image"];
                document.getElementById('reservPrewDesc').innerHTML = data["description"];
                document.getElementById('reservPrewFeature').innerHTML = data["features"];
                document.getElementById('reservPrewPrice').innerHTML = data["price"]+'.-HUF/<i class="fa-regular fa-moon-stars"></i>';
                document.getElementById('reservPrewNumbers').innerHTML = "Emelet: "+data["floor"]+" | Szobaszám: "+data["number"];
                document.getElementById('reservPrewAccom').innerHTML = "Kapacitás: "+data["accomodation"]+" Fő";
                document.getElementById('reservPrewSize').innerHTML = "Szoba méret: "+data["size"];
            }
        });
    }
</script>
<script>
    function confirmDel(id, postNum, cityName, strName, houseNum){
        var data = postNum +" "+ cityName +" "+ strName +" "+ houseNum;
        Swal.fire({
            icon: 'question',
            title: 'Biztosan törölni szeretné mentett adatát?',
            html: '<p>Ezt az adatát szeretné törölni?</p><br><pre>'+data+'</pre>',
            showConfirmButton: true,
            showDenyButton: true,
            confirmButtonText: 'Igen!',
            denyButtonText: 'Nem!'
        }).then((result) =>{
            if(result.isConfirmed){
                delSavedLoc(id);
                Swal.fire({
                    title: 'Adat törölve!',
                    icon: 'success',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    title: 'Valami nem sikerült!',
                    icon: 'error',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                })
            }
            if(result.isDenied){
                Swal.fire({
                    tile: 'Adattörlés megszakítva!',
                    icon: 'error',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                })
            }
        })
    }
    function delSavedLoc(id){
        $.ajax({
            url: '/korondi/Assets/php/delLocation.php',
            type: 'POST',
            data: {'id': id},
            success: function (response) {
                setTimeout(location.reload.bind(location), 2100)
                //location.reload(true);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
    }
</script>