const newRoomDesc = document.getElementById('formRoomDescription');
const previewDescription = document.getElementById('prewDesc');
const inputIconSet = document.getElementById('iconOptions');
const previewFeatures = document.getElementById('prewFeatures');
const newRoomPrice = document.getElementById('formRoomPrice');
const newRoomFloor = document.getElementById('formRoomFloor');
const newRoomNumber = document.getElementById('formRoomNum');
const imgInput = document.getElementById('formFile');
const previewImage = document.getElementById('prewImg');

newRoomDesc.addEventListener('input', () => {
    if(newRoomDesc.value.length !== 0) {
        document.getElementById('formRoomDescriptionLabel').innerHTML = "200/" + (200 - newRoomDesc.value.length);
        previewDescription.textContent = newRoomDesc.value;
    } else {
        document.getElementById('formRoomDescriptionLabel').innerHTML = "Leírás, max. 200 karakter!";
        previewDescription.innerHTML = "Ez egy alapértelmezett leírás a szobáról. Valahogy így fog kinézni.";
    }
    newRoomDesc.style.height = "";newRoomDesc.style.height = newRoomDesc.scrollHeight + "px";

});

newRoomPrice.addEventListener('input', () => {
    document.getElementById('prewPrice').innerHTML = newRoomPrice.value+".-HUF/<i class=\"fa-regular fa-moon-stars\"></i>";
});

newRoomFloor.addEventListener('input', () => {
    document.getElementById('prewRoomNum').innerHTML = "Emelet: "+newRoomFloor.value+" | Szobaszám: "+newRoomNumber.value;
});

newRoomNumber.addEventListener('input', () => {
    document.getElementById('prewRoomNum').innerHTML = "Emelet: "+newRoomFloor.value+" | Szobaszám: "+newRoomNumber.value;
});



imgInput.onchange = evt => {
    const [file] = imgInput.files;
    if(file){
        previewImage.src.replace("/korondi/Assets/images/defaultImage.png", "#");
        previewImage.src = URL.createObjectURL(file);
    }
}