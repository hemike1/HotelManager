<div class="row">
	<?php
	    foreach($rooms as $roomInfo) {
			echo '  
  			<div class="col-3">
	        	<div class="card">
	        	    <img src="' . $room->getRoomImgDir() . '/' . $roomInfo['image'] . '" class="card-img-top img-thumbnail">
	        	    <div class="card-body">
	        	        <p class="card-text">' . $roomInfo['description'] . '</p>
	        	    </div>
	        	    <ul class="list-group list-group-flush text-center"> 
	        	        <li class="list-group-item fs-3">'.$roomInfo['features'].'</li>
						<li class="list-group-item fs-5">'.$roomInfo['price'].'.-HUF/<i class="fa-regular fa-moon-stars"></i></li>
                        <li class="list-group-item fs-5">Emelet: '.$roomInfo['floor'].' | Szobaszám: '.$roomInfo['number'].'</li>
                    </ul>
	        	</div>
	        </div>';
		}
	?>
</div>