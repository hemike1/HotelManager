const desc = document.getElementById('newroomdescription');
desc.addEventListener('input', () => {
    if(desc.value.length !== 0) {
        document.getElementById('newroomcount').innerHTML = "200/" + (200 - desc.value.length);
    } else {
        document.getElementById('newroomcount').innerHTML = "Leírás, max. 200 karakter!";
    }
    desc.style.height = "";desc.style.height = desc.scrollHeight + "px";
});