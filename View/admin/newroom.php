<div class="row">
    <div class="col-8">
        <form method="post" enctype="multipart/form-data">
            <!-- Done stuff -->
            <div class="input-group mb-3">
                <label for="formSize" class="input-group-text m-0">Szoba méret</label>
                <select id="formSize" name="formSize" class="form-select me-1" required>
                    <option value="" selected disabled>Válassz...</option>
                    <option value="Kicsi">Kicsi</option>
                    <option value="Közepes">Közepes</option>
                    <option value="Nagy">Nagy</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <span for="formRoomFloor" class="input-group-text">Emelet</span>
                <input required type="number" id="formRoomFloor" name="formRoomFloor" class="form-control col-3" max="20" placeholder="Csak számok!">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Szoba szám</span>
                <input required type="number" id="formRoomNum" name="formRoomNum" class="form-control ms-1 col-3" max="30" placeholder="Csak számok!">
            </div>
            <div class="input-group mb-3 col-6">
                <span for="formFile" class="input-group-text">Bemutató kép a szobáról</span>
                <input required class="form-control" type="file" name="<?php echo $imageID;?>" id="<?php echo $imageID;?>">
                <!-- <button class="btn btn-outline-secondary">Upload</button> -->
            </div>
            <div class="input-group mb-3 col-6">
                <span class="input-group-text">Fő/szoba</span>
                <input required type="number" class="form-control ms-1 col-3" id="formAcc" name="formAcc" max="10" placeholder="Csak számok!">
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text m-0" for="inputGroupSelect01">Jellemzők</label>
                <select class="form-select me-1" id="formIconOptions" name="formIconOptions" onchange="getIcons()" required>
                    <option selected disabled>Válassz...</option>
	    			<?php
	    			$sql = $this->prepare('SELECT * FROM ' . $GLOBALS['prefix'] . 'features');
	    			$sql->execute();
	    			if ($result = $sql->get_result()) {
	    				if ($result->num_rows > 0) {
	    					while ($row = $result->fetch_assoc()) {
	    						echo '<option value="' . $row['featureId'] . '">' . $row['featureName'] . '</option>';
	    					}
	    				}
	    			}
	    			?>
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">HUF.-/<i class="fa-regular fa-moon-stars"></i></span>
                <input required type="number" class="form-control" id="formRoomPrice" name="formRoomPrice"max="999999" placeholder="Csak számok!">
            </div>
            <div class="form-floating">
                <textarea required class="form-control" aria-label="With textarea" name="formRoomDescription" id="formRoomDescription" maxlength="200"
                          placeholder="Leírás, max. 200 karakter!"></textarea>
                <label id="formRoomDescriptionLabel" for="formRoomDescription">Leírás, max 200 karakter!</label>
            </div>
            <div class="form-floating mb-3">
                <button type="submit" class="btn color-custom bg-color-custom mt-3">Új szoba létrehozása</button>
            </div>
        </form>
    </div>
    <div class="col-4">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <img src="/korondi/Assets/images/defaultImage.png" alt="Preview Image" id="prewImg" class="card-img-top img-thumbnail">
                    <div class="card-body">
                        <p class="card-text" id="prewDesc">Ez egy alapértelmezett leírás a szobáról. Valahogy így fog
                            kinézni.</p>
                    </div>
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item fs-3" id="prewFeatures"></li>
                        <li class="list-group-item fs-5" id="prewPrice">.-HUF/<i class="fa-regular fa-moon-stars"></i></li>
                        <li class="list-group-item fs-5" id="prewRoomNum"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/korondi/Assets/js/counters.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
<script>
    function getIcons() {
        $.ajax({
            url: '/korondi/Assets/php/getIcons.php',
            type: 'POST',
            data: {'iconId': document.getElementById('formIconOptions').value},
            success: function (response) {
                document.getElementById('prewFeatures').innerHTML = response;
            }
        })
    }
</script>