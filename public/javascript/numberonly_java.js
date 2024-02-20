try {
    // Select the submit button
    var submitButton = document.querySelector('button[type="submit"]');

    document.getElementById("priceInput").addEventListener("input", function (event) {
        this.value = this.value.replace(/[eE]/g, "");
    });

    document.getElementById("priceInput").addEventListener("blur", function (event) {
        // Check if the input value is empty or null
        if (this.value.trim() === "") {
            // Set a default value higher than the cost price
            this.value = (parseFloat(document.getElementById("disabled-input-2").value) + 1).toFixed(2);
        } else {
            // Format the value to have two decimal places
            var formattedValue = parseFloat(this.value).toFixed(2);
            this.value = formattedValue;
        }

        var priceValue = parseFloat(this.value);
        var costPrice = parseFloat(document.getElementById("disabled-input-2").value);
        if (priceValue < costPrice) {
            alert("Price cannot be lower than the cost price.");
            submitButton.disabled = true;
        } else {
            submitButton.disabled = false;
        }
    });

    document.getElementById("volume").addEventListener("input", function (event) {
        this.value = this.value.replace(/[eE]/g, "");
    });

    document.getElementById("volume").addEventListener("blur", function (event) {
        var priceValue = parseFloat(this.value);
        var costPrice = parseFloat(document.getElementById("Reoder_Level").value);
        if (priceValue < costPrice) {
            alert("Price cannot be lower than the cost price.");
            submitButton.disabled = true;
        } else {
            submitButton.disabled = false;
        }
    });
} catch (error) {
    // Handle the error silently (i.e., without displaying it)
    // You can choose to log it or simply ignore it
}
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
