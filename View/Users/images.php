<!--TODO:php script for enabling lvl 3 permission to upload images, otherwise only viewing is allowed-->
<div class="container">
    <?php
        if($user->getPermission() == 3) {
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
    <div class="carousel slide w-75 rounded-2" id="imageCarousel" data-bs-ride="carousel"> <!-- images from unsplash; https://unsplash.com/s/photos/hotel-room -->
        <?php
        $dir = "/var/www/clients/client31/web184/web/korondi/Assets/images/showroom/";
	    $extensions = array('jpg','png','jpeg','gif');
	    $files = scandir($dir);
        ?>
        <div class="carousel-indicators"><!-- indicators -->
			<?php
			for ($i = 0; $i < count($files)-2; $i++) {
				if($i == 2) {
					echo '<button type="button" data-target="imageCarousel" class="active" aria-current="true" data-slide-to="' . $i . '"></button>';
				} else {
					echo '<button type="button" data-target="imageCarousel" data-slide-to="' . $i . '"></button>';
				}
			}
			?>
        </div>
        <div class="carousel-inner"><!-- carousel items -->
        <?php
            for ($i = 0; $i < count($files)-2; $i++) {
                if($files[$i] != '.' && $files[$i] != '..')
                    if($i == 2) {
						echo '<div class="carousel-item active"><img class="d-block w-100" src="/korondi/Assets/images/showroom/' . $files[$i] . '"></div>';
					} else {
						echo '<div class="carousel-item"><img class="d-block w-100" src="/korondi/Assets/images/showroom/' . $files[$i] . '"></div>';
					}
            }
        ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="imageCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="imageCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<script>
    const myCarouselElement = document.querySelector('imageCarousel')

    const carousel = new bootstrap.Carousel(myCarouselElement, {
        interval: 2000,
        touch: true
    })
</script>