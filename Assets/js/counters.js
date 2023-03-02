const newRoomDesc = document.getElementById('newroomdescription');
const previewDescription = document.getElementById('prewDesc');
const inputIconSet = document.getElementById('iconOptions');
const previewFeatures = document.getElementById('prewFeatures');
const newRoomPrice = document.getElementById('newRoomPrice');
const newRoomFloor = document.getElementById('formRoomFloor');
const newRoomNumber = document.getElementById('formRoomNum');
const imgInput = document.getElementById('formFile');
const previewImage = document.getElementById('prewImg');

newRoomDesc.addEventListener('input', () => {
    if(newRoomDesc.value.length !== 0) {
        document.getElementById('newroomcount').innerHTML = "200/" + (200 - newRoomDesc.value.length);
    } else {
        document.getElementById('newroomcount').innerHTML = "Leírás, max. 200 karakter!";
    }
    newRoomDesc.style.height = "";newRoomDesc.style.height = newRoomDesc.scrollHeight + "px";
    previewDescription.textContent = newRoomDesc.value;
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

inputIconSet.addEventListener("change", () => {
    previewFeatures.textContent = inputIconSet.value;
})

imgInput.onchange = evt => {
    const [file] = imgInput.files;
    if(file){
        previewImage.src.replace("/korondi/Assets/images/defaultImage.png", "#");
        previewImage.src = URL.createObjectURL(file);
    }
}