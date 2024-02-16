document.getElementById("priceInput").addEventListener("input", function (event) {
    // Prevent scientific notation by removing any "e" or "E" characters
    this.value = this.value.replace(/[eE]/g, "");
});

document.getElementById("priceInput").addEventListener("blur", function (event) {
    // Format the value to have two decimal places
    var formattedValue = parseFloat(this.value).toFixed(2);
    // Update the input field value with the formatted value
    this.value = formattedValue;
});

document.getElementById("volume").addEventListener("input", function (event) {
    this.value = this.value.replace(/[eE]/g, "");
});

// document.getElementById("volume").addEventListener("input", function (event) {
//     var volume = this.value.trim();
//     var isValid = /^\d+$/.test(volume); // Check if input contains only digits
//     var errorElement = document.getElementById("volume_error");

//     if (!isValid) {
//         errorElement.textContent = "Volume must be a number";
//         this.setCustomValidity("Invalid volume");
//     } else {
//         errorElement.textContent = "";
//         this.setCustomValidity("");
//     }
// });
