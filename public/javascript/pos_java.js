const modalButtons = document.querySelectorAll('.modalButton');
const modal = document.getElementById('myModal');
const closeModal = document.getElementById('cancelButton');
const productName = document.getElementById('productName');
const productDetails = document.getElementById('productDetails');
const prdo = document.getElementById('available');
const prdo1 = document.getElementById('cost');
const prdo2 = document.getElementById('name');
const prdo3 = document.getElementById('price');
const prdo4 = document.getElementById('Sub_Total');
const Customer_Name = document.getElementById('Customer_Name');
const orderMessage = document.getElementById('order_message');
const product_id = document.getElementById('product_id');

let priceper = 0; // Declare priceper variable
let costper = 0;
modalButtons.forEach(button => {
    button.addEventListener('click', () => {
        const id = button.getAttribute('data-product-id');
        const name = button.getAttribute('data-product-name');
        const price = button.getAttribute('data-selling-price');
        const cost = button.getAttribute('data-num-cost');
        prdo3.value = price;
        costper = cost;
        priceper = price;
        const numProducts = button.getAttribute('data-num-products');
        productName.textContent = name.toUpperCase();
        prdo2.value = name;
        product_id.value = id;
        productDetails.innerHTML = `Price: ₱${price}<br>Available Qty: ${numProducts}<br>`;
        prdo.value = numProducts;
        modal.classList.remove('hidden');
    });
});

closeModal.addEventListener('click', () => {
    modal.classList.add('hidden');
});



document.getElementById('available').addEventListener('blur', function () {
    checkOrder();
});

function checkOrder() {
    var availableInput = document.getElementById('available');
    var orderQuantityInput = document.getElementById('order_quantity');
    var orderMessage = document.getElementById('order_message');
    var submitBtn = document.getElementById('submitBtn');
    var totalPriceSpan = document.getElementById('Total');

    var availableQuantity = parseInt(availableInput.value);
    var orderQuantity = parseInt(orderQuantityInput.value);

    if (isNaN(availableQuantity) || isNaN(orderQuantity) || orderQuantity <= 0) {
        prdo1.value = 0.00;
        totalPriceSpan.textContent = "Total: ₱0.00";
        orderMessage.textContent = "Please enter a valid positive order quantity.";
        orderMessage.style.color = "white";
        orderMessage.style.backgroundColor = "red"
        submitBtn.disabled = true; // Disable submit button
        return;
    }
    if (availableQuantity >= orderQuantity) {
        var totalPrice = orderQuantity * priceper;
        var totalPrice1 = orderQuantity * costper;
        prdo1.value = totalPrice1;

        totalPriceSpan.textContent = "Total: ₱" + totalPrice.toFixed(2);
        orderMessage.textContent = "Order placed successfully!";
        orderMessage.style.backgroundColor = "white"
        orderMessage.style.color = "black";
        prdo4.value = totalPrice.toFixed(2);
        submitBtn.disabled = false; // Enable submit button
    } else {
        prdo1.value = 0.00;
        totalPriceSpan.textContent = "Total: ₱0.00";
        orderMessage.textContent = "Insufficient quantity available.";
        orderMessage.style.color = "white";
        orderMessage.style.backgroundColor = "red"
        submitBtn.disabled = true; // Disable submit button
    }

}


document.getElementById('sellButton').addEventListener('click', function () {

    const Cust = document.getElementById('first_name');
    Customer_Name.value = Cust.value;


    var form = document.getElementById('sellForm');
    var orNumber = '{{ $sale->first()->OrNumber }}';
    // Update the action attribute of the form with the correct OR value
    form.action = form.action.replace('{OR}', orNumber);

    // Submit the form
    form.submit();
});