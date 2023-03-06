<!--TODO:php script for enabling lvl 3 permission to upload images, otherwise only viewing is allowed-->
<div class="container">
    <?php
        if($user->getPermission() == 3) {
            echo '<form class="row g-3" method="post" enctype="multipart/form-data">
                    <div class="col-auto">
                        <input class="form-control" type="file" name="'.$imageID.'" id="'.$imageID.'" multiple>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn bg-color-custom color-custom">Feltöltés</button>
                    </div>
                </form>';
        }
    ?>
    <div class="row"> <!-- images from unsplash; https://unsplash.com/s/photos/hotel-room -->
        <?php
        $tmpDir = "/var/www/clients/client31/web184/web/korondi/Assets/images/showroom/";
        $imgDir = "/korondi/Assets/images/showroom/";
	    $extensions = array('jpg','png','jpeg','gif');
	    $files = scandir($tmpDir);
        foreach($files as $image){
            if($image != "." && $image != "..")
                echo '<div class="col-12 col-md-6 col-lg-3"><img class="rounded border-1 custom-border-color m-1 img-fluid" src="'.$imgDir.$image.'"></div>';
        }
		?>
    </div>
</div>
