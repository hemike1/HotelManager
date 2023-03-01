<div class="row">
	<?php
	    foreach($rooms as $room) {
			echo '  
  			<div class="col-3">
	        	<div class="card">
	        	    <img src="' . $user->getRoomImgDir() . '/' . $room['image'] . '.jpg" class="card-img-top img-thumbnail">
	        	    <div class="card-body">
	        	        <p class="card-text">' . $room['description'] . '</p>
	        	    </div>
	        	    <ul class="list-group list-group-flush text-center"> 
	        	        <li class="list-group-item fs-3">'.$room['features'].'</li>
						<li class="list-group-item fs-5">'.$room['price'].'.-HUF/<i class="fa-regular fa-moon-stars"></i></li>
                        <li class="list-group-item fs-5">Emelet: '.$room['floor'].' | Szobaszám: '.$room['number'].'</li>
                    </ul>
	        	</div>
	        </div>';
		}
	?>
</div>