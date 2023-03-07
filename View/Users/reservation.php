<div class="row gx-2">
	<?php
	    foreach($rooms as $roomInfo) {
			echo '  
  			<div class="col-12 col-md-6 col-lg-3">
	        	<div class="card mb-2">
	        	    <img src="' . $room->getRoomImgDir() . '/' . $roomInfo['image'] . '" class="card-img-top img-thumbnail">
	        	    <div class="card-body">
	        	        <p class="card-text">' . $roomInfo['description'] . '</p>
	        	    </div>
	        	    <ul class="list-group list-group-flush text-center mb-2"> 
	        	        <li class="list-group-item fs-3">'.$roomInfo['features'].'</li>
						<li class="list-group-item fs-5">'.$roomInfo['price'].'.-HUF/<i class="fa-regular fa-moon-stars"></i></li>
                        <li class="list-group-item fs-5">Emelet: '.$roomInfo['floor'].' | Szobaszám: '.$roomInfo['number'].'</li>
                    </ul>
                    <button type="button" class="btn bg-color-custom color-custom fs-5 fw-bold ms-5 mb-2 me-5" data-bs-toggle="modal" data-bs-target="#reservationModal" onclick="reservRoom('.$roomInfo['roomId'].')">
                    Előnézet
                    </button>
	        	</div>
	        </div>';
		}
	?>
</div>
<!-- Modal -->
<div class="modal fade modal-xl" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
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

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Bezárás</button>
                <button type="button" class="btn bg-color-custom color-custom">Foglalás</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
<script>
    function reservRoom(roomId){
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
                console.log(response);
            }
        });
    }
</script>
