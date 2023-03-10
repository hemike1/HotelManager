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

<div class="modal fade modal-xl" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
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
                    <div class="col-8 g-2">
                        <input type="text" id="reservRoomId" hidden readonly>
                        <select class="form-select mb-3" id="billingData" name="billingData" onchange="setBillingData()" required>
                            <option value="" selected disabled>Elmentett számlázási adatok</option>
                            <option value="new">Új számlázási hely felvétele</option>
                            <?php
                                if(!empty($locations)){
                                    foreach($locations as $location){
                                        echo '<option value="'.$location['id'].'">'.$location['postNum'].' '.$location['cityName'].' '.$location['streetName'].' '.$location['houseNum'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <div class="row">
                            <div class="col-12">
                                <input type="text" name="cityid" data-live-search="true" id="cityid" hidden disabled>
                                <div class="input-group mb-3">
                                    <select class="select2 form-select" id="cidyandpostnum" name="state">
                                        <?php
                                        foreach($cities as $city){
                                            echo '<option value="'.$city['id'].'">'.$city['postNum'].' '.$city['cityName'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group col-6 mb-5">
                                    <span class="input-group-text"><i class="fa-regular fa-road"></i></span>
                                    <input type="text" class="form-control" name="strname" id="strname" placeholder="Utca neve">
                                    <span class="input-group-text"><i class="fa-regular fa-input-numeric"></i></span>
                                    <input type="text" class="form-control" name="housenum" id="housenum" placeholder="Házszám">
                                </div>
                                <div class="input-group mt-5">
                                    <span class="input-group-text">Szoba foglalás kezdete</span>
                                    <input type="date" class="form-control" name="reservStartDate" placeholder="ÉÉÉÉ-HH-NN" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required>
                                </div>
                                <div class="input-group mt-3">
                                    <span class="input-group-text">Szoba foglalás vége</span>
                                    <input type="date" class="form-control" name="reservEndDate" placeholder="ÉÉÉÉ-HH-NN" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Bezárás</button>
                <button type="submit" class="btn bg-color-custom color-custom">Foglalás</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    var cities = document.getElementById('cidyandpostnum');
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
                document.getElementById('reservRoomId').innerHTML = data["roomId"];
            }
        });
    }
        function setBillingData(){
            const billingId = document.getElementById('billingData');
            const selectedBilling = billingId.value;
            if(billingId.options[billingId.selectedIndex].value !== "" && billingId.options[billingId.selectedIndex].value !== "new") {
                $.ajax({
                    url: '/korondi/Assets/php/getbillinginfo.php',
                    method: 'POST',
                    data: {'billId': billingId.value},
                    success: function(response){
                        var data = JSON.parse(response);
                        document.getElementById('cidyandpostnum').value = data['cityId'];
                        $('.select2').trigger('change');
                        $('#cidyandpostnum').prop('disabled', true);
                        document.getElementById('strname').value = data['street'];
                        document.getElementById('housenum').value = data['houseNum']
                        document.getElementById('strname').disabled = true;
                        document.getElementById('housenum').disabled = true;
                    }
                })//ajax
            } else {
                $('#cidyandpostnum').prop('disabled', false);
                document.getElementById('strname').value = "";
                document.getElementById('housenum').value = "";
                document.getElementById('strname').disabled = false;
                document.getElementById('housenum').disabled = false;
            }
        }
    $(document).ready(function(){
        $('.select2').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#reservationModal')
        });
    });
</script>
