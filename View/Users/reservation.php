<div class="row">
	<?php
	    foreach($rooms as $room) {
			echo '  
  			<div class="col-3">
	        	<div class="card">
	        	    <img src="'.$user->getRoomImgDir().'/'.$room['image'].'.jpg" class="card-img-top img-thumbnail">
	        	    <div class="card-body">
	        	        <p class="card-text">'.$room['description'].'</p>
	        	    </div>
	        	</div>
	        </div>
	        ';
		}
	?>
</div>