const modalButtons = document.getElementsByClassName('modalButtonUpdate');
const closeModal = document.getElementById('closeModal1');
const modal = document.getElementById('myModal1');

// Get references to form fields
const recipeNameField = document.getElementById('recipe1');
const brandField = document.getElementById('brand1');
const supplierField = document.getElementById('supplier1');
const unitField = document.getElementById('unit1');
const reorderLevelField = document.getElementById('Reoder_Level1');
const volumeField = document.getElementById('volume1');
const priceField = document.getElementById('priceInput1');
const pickUpOrDeliveryField = document.getElementById('pick_up_or_delivery1');
const contactNumberField = document.getElementById('contact_number1');
const contactPersonField = document.getElementById('contact_person');
const remaining = document.getElementById('remaining1');
const recipe_id1 = document.getElementById('recipe_id1');

// Loop through modalButtons and attach event listener to each
for (let i = 0; i < modalButtons.length; i++) {
    modalButtons[i].addEventListener('click', (event) => {
        // Get data attributes from the clicked element
        const recipeID = event.target.getAttribute('data-id');
        const recipeName = event.target.getAttribute('data-recipe_name');
        const brandName = event.target.getAttribute('data-brand_name');
        const supplierName = event.target.getAttribute('data-supplier_name');
        const unitName = event.target.getAttribute('data-unit_name');
        const reorderLevel = event.target.getAttribute('data-reorder_lvl');
        const volume = event.target.getAttribute('data-volume');
        const price = event.target.getAttribute('data-price');
        const pickUpOrDelivery = event.target.getAttribute('data-pick_up_or_delivery');
        const contactNumber = event.target.getAttribute('data-contact_number');
        const contactPerson = event.target.getAttribute('data-contact_person');
        const remainingV = event.target.getAttribute('data-remaining');
 
        console.log("Recipe Name:", recipeID);
        console.log("Recipe Name:", recipeName);
        console.log("Brand Name:", brandName);
        console.log("Supplier Name:", supplierName);
        console.log("Unit Name:", unitName);
        console.log("Reorder Level:", reorderLevel);
        console.log("Volume:", volume);
        console.log("Price:", price);
        console.log("Pick Up/Delivery:", pickUpOrDelivery);
        console.log("Contact Number:", contactNumber);
        console.log("Contact Person:", contactPerson);

        const recipeOptions = recipeNameField.options;
        for (let j = 0; j < recipeOptions.length; j++) {
            if (recipeOptions[j].text === recipeName) {
                recipeOptions[j].selected = true;
                break; // Once found, exit the loop
            }
        }
        // Populate form fields with the retrieved data
        // recipeNameField.value = recipeName || '';
        recipe_id1.value = recipeID|| '';
        brandField.value = brandName || '';
        remaining.value = remainingV || '';
        supplierField.value = supplierName || '';
        unitField.value = unitName || '';
        reorderLevelField.value = reorderLevel || '';
        volumeField.value = volume || '';
        priceField.value = price || '';
        pickUpOrDeliveryField.value = pickUpOrDelivery || '';
        contactNumberField.value = contactNumber || '';
        contactPersonField.value = contactPerson || '';

        // Show the modal
        modal.classList.remove('hidden');
    });
}

// Function to close modal
const closeFunction = () => {
    modal.classList.add('hidden');
};

// Close modal when close button is clicked
closeModal.addEventListener('click', closeFunction);
