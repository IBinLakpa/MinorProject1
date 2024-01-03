function set_total(){
    var elements = document.getElementsByClassName('subTotal');

    // Initialize a variable to store the sum
    var sum = 0;

    // Loop through each element and extract the number from its text content
    for (var i = 0; i < elements.length; i++) {
        // Extract the number using a regular expression
        var number = parseInt(elements[i].innerText.match(/[\d.]+/));

        // Add the extracted number to the sum (if it's a valid number)
        if (!isNaN(number)) {
            sum += number;
        }
    }
    document.getElementById('g_total').innerText=sum;

}
function plus(operator) {
    var productId = document.getElementById(operator);
    var subTotalElement = document.querySelector(".subTotal." + operator);
    var rateElement = document.querySelector(".rate." + operator);

    var rate = parseInt(rateElement.innerText);
    var qty = parseInt(productId.innerText);

    if (qty == 100) {
        alert("Limit reached");
    } else {
        productId.innerText = ++qty;
        subTotalElement.innerText = rate * qty;
        set_total();
    }
}

function minus(operator){
    var productId = document.getElementById(operator);
    var subTotalElement = document.querySelector(".subTotal." + operator);
    var rateElement = document.querySelector(".rate." + operator);

    var rate = parseInt(rateElement.innerText);
    var qty = parseInt(productId.innerText);
    if(qty==0){
        alert('invalid amount');
    }
    else{
        productId.innerText=--qty;
        subTotalElement.innerText = rate * qty;
        set_total();
    }
}

function startInterval(operator,elementId) {
    if (operator === '-') {
        minus(elementId);
        intervalId = setInterval(function () {
            minus(elementId);
        }, 250);
    } else if(operator==='+') {
        plus(elementId);
        intervalId = setInterval(function () {
            plus(elementId);
        }, 500);
    }
}

function stopInterval() {
    clearInterval(intervalId);
}

function notification(msg) {
    var newDiv = document.createElement('div');
    newDiv.innerHTML = msg;
    newDiv.classList.add('alert');
    document.body.appendChild(newDiv);
    setTimeout(function () {
        document.body.removeChild(newDiv);
    }, 1500);
}

function getFirstWord(inputString) {
    // Trim leading and trailing spaces and then split the string into an array of words
    var words = inputString.trim().split(/\s+/);

    // Return the first word (or an empty string if there are no words)
    return words.length > 0 ? words[0] : '';
}

function del(identifier){
    // Get a reference to the elements with the specified class name
    var elementsToRemove = document.getElementsByClassName(identifier);
    notification(getFirstWord(elementsToRemove[0].innerText)+" has been deleted");

    // Remove all elements with the specified class
    while (elementsToRemove.length > 0) {
        elementsToRemove[0].remove();
    }
    set_total();
}
