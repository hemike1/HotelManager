<!--TODO:php script for enabling lvl 3 permission to upload images, otherwise only viewing is allowed-->
<div class="container">
    <?php
        if($uploadPriv == 1) {
            echo '<form class="row g-3">
                    <div class="col-auto">
                        <input class="form-control" type="file" name="file" id="formFileMultiple" multiple>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn bg-color-custom color-custom">Feltöltés</button>
                    </div>
                </form>';
        }
        $imgName = $_FILES['file']['name'];
        $imgType = $_FILES['file']['type'];
        $user->uploadImage($imgName, $imgType);
    ?>
    <div class="row row-cols-4"> <!-- images from unsplash; https://unsplash.com/s/photos/hotel-room -->
        <div class="col">Column</div>
        <?php
		$dir = "http://banki13.komarom.net/korondi/Assets/images/showroom/";
		$files = scandir($dir . '*.jpg');

		foreach($files as $file) {
			echo '<img src="' . $file . '" />';
		}
        ?>
    </div>
</div>