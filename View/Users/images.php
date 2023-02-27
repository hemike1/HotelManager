<!--TODO:php script for enabling lvl 3 permission to upload images, otherwise only viewing is allowed-->
<div class="container">
    <div class="row row-cols-4"> <!-- images from unsplash; https://unsplash.com/s/photos/hotel-room -->
        <div class="col">Column</div>
        <?php
		$dir = "/Assets/images/showroom/";
		$files = glob($dir . '*.jpg');

		foreach($files as $file) {
			echo '<img src="' . $file . '" />';
		}
        ?>
    </div>
</div>