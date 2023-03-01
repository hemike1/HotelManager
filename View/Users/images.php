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
    ?>
    <div class="row row-cols-4"> <!-- images from unsplash; https://unsplash.com/s/photos/hotel-room -->
        <div class="col">Column</div>
        <?php
		$dir = "/korondi/Assets/images/showroom/";
        $extensions = array('jpg','png','jpeg','gif');
		$files = scandir($dir);
        for ($i = 0; $i < count($files); $i++) {
            $file = pathinfo($files[$i]);
            $extension = $file['extension'];
            echo '<img src="'.$dir.$files[$i].$extension.'">';
        }
        ?>
    </div>
</div>