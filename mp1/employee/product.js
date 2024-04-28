function updateImg() {
    var preview = document.getElementById('preview');
    var file = document.getElementById('image').files[0]; // Change 'imageInput' to 'image'
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.style.backgroundImage = "url('" + reader.result + "')";
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.style.backgroundImage = ""; // Clear the background image if no file is selected
    }    
}
function updateCategory() {
    var selectElement = document.getElementById('categorySelection');

    // Get the index of the selected option
    var selectedIndex = selectElement.selectedIndex;

    // Get the selected option element
    var selectedOption = selectElement.options[selectedIndex];

    // Get the value and text of the selected option
    var selectedValue = selectedOption.value;
    document.getElementById('category').innerText = selectedOption.textContent;
}
function updateRate() {
    document.getElementById('rate').innerText = document.getElementById('rateInput').value;
}
function updateName() {
    document.getElementById('name').innerText = document.getElementById('nameInput').value;
}