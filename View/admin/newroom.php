<div class="col-6 m-5">
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">@</span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>




<!-- Done stuff -->

    <div class="input-group mb-3">
        <label class="input-group-text m-0" for="inputGroupSelect01">Méret</label>
        <select class="form-select me-1" id="inputGroupSelect01">
            <option selected>Válassz...</option>
            <?php
            $sql = $this->prepare('SELECT * FROM '.$GLOBALS['prefix'].'features');
            $sql->execute();
            if($result = $sql->get_result()){
                if($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row['featureId'].'">'.$row['featureName'].'</option>';
                    }
                }
            }
            ?>
        </select>

        <input type="text" class="form-control">
        <span class="input-group-text">HUF.-/<i class="fa-regular fa-moon-stars"></i></span>

    </div>

    <div class="input-group mb-3">

    </div>

    <div class=" form-floating">
        <textarea class="form-control" aria-label="With textarea" id="newroomdescription" maxlength="200" placeholder="Leírás, max. 200 karakter!" ></textarea>
        <label id="newroomcount" for="description">Leírás, max 200 karakter!</label>
    </div>
</div>