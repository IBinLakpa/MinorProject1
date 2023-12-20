function plus(operator){
    productId=document.getElementById(operator);
    qty=parseInt(productId.innerText);
    console.log('+');
    if(qty==100){
        alert("limit reached");
    }
    else{
        productId.innerText=qty+1;
    }
}

function minus(operator){
    productId=document.getElementById(operator);
    qty=parseInt(productId.innerText);
    if(qty==0){
        alert('invalid amount');
    }
    else{
        productId.innerText=qty-1;
    }
}

function startInterval(operator,elementId) {
    if (operator === '-') {
        minus(elementId);
        intervalId = setInterval(function () {
            minus(elementId);
        }, 500);
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

function addAlert() {
    var newDiv = document.createElement('div');
    newDiv.innerHTML = 'This is a dynamically created div!';
    newDiv.classList.add('alert');
    document.body.appendChild(newDiv);
    setTimeout(function () {
        document.body.removeChild(newDiv);
    }, 3000); // 3000 milliseconds = 3 seconds
}