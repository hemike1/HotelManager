<div class="row">
    <div class="col-10">

    <!-- Done stuff -->
        <div class="input-group mb-3">
            <label for="formSize" class="input-group-text m-0">Szoba méret</label>
            <select id="formSize" class="form-select me-1">
                <option value="" selected>Válassz...</option>
                <option value="Small">Kicsi</option>
                <option value="Medium">Közepes</option>
                <option value="Large">Nagy</option>
            </select>
            <input type="number" id="formRoomFloor" class="form-control col-3" placeholder="Csak számok!">
            <span for="formRoomFloor" class="input-group-text">Emelet</span>
            <input type="number" id="formRoomNum" class="form-control ms-1 col-3" placeholder="Csak számok!">
            <span class="input-group-text">Szoba szám</span>
        </div>

        <!-- half done, TODO: waiting to be implemented -->
        <div class="input-group mb-3 col-6">
            <label for="formFile" class="form-label">Bemutató kép a szobáról</label>
            <input class="form-control" type="file" id="formFile">
        </div>
            <div class="input-group mb-3 col-6">
                <input type="number" class="form-control ms-1 col-3" placeholder="Csak számok!">
                <span class="input-group-text">Fő/szoba</span>
            </div>



        <!-- end of half done -->

        <div class="input-group mb-3">
            <label class="input-group-text m-0" for="inputGroupSelect01">Jellemzők</label>
            <select class="form-select me-1" id="iconOptions">
                <option selected>Válassz...</option>
                <?php
                $sql = $this->prepare('SELECT * FROM '.$GLOBALS['prefix'].'features');
                $sql->execute();
                if($result = $sql->get_result()){
                    if($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['featureIcon'].'">'.$row['featureName'].'</option>';
                        }
                    }
                }
                ?>
            </select>
            <input type="number" class="form-control" id="newRoomPrice" placeholder="Csak számok!">
            <span class="input-group-text">HUF.-/<i class="fa-regular fa-moon-stars"></i></span>
        </div>

        <div class=" form-floating">
            <textarea class="form-control" aria-label="With textarea" id="newroomdescription" maxlength="200" placeholder="Leírás, max. 200 karakter!" ></textarea>
            <label id="newroomcount" for="description">Leírás, max 200 karakter!</label>
        </div>
    </div>
    <div class="col-2">
        <div class="row">
            <div class="card">
                <img src="/korondi/Assets/images/defaultImage.png" class="card-img-top img-thumbnail">
                <div class="card-body">
                    <p class="card-text" id="prewDesc">Ez egy alapértelmezett leírás a szobáról. Valahogy így fog kinézni.</p>
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