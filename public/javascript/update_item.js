const modalButtons = document.getElementsByClassName('modalButtonUpdate');
const closeModal = document.getElementById('closeModal1');
const modal = document.getElementById('myModal1');


const ItemID = document.getElementById('ItemID');
const productName = document.getElementById('productName');
const Images = document.getElementById('Image');
const Categories = document.getElementById('Categories');
const CostPrice = document.getElementById('CostPrice');
const SellingPrice = document.getElementById('SellingPrice');
const Size = document.getElementById('SizeName');
console.log(Size);
// Loop through modalButtons and attach event listener to each
for (let i = 0; i < modalButtons.length; i++) {
    modalButtons[i].addEventListener('click', (event) => {

        const id = event.target.getAttribute('data-id');
        const product = event.target.getAttribute('data-product');
        const images = event.target.getAttribute('data-images');
        const categories = event.target.getAttribute('data-categories');
        const cost = event.target.getAttribute('data-cost');
        const price = event.target.getAttribute('data-price');
        const size = event.target.getAttribute('data-size');

        ItemID.value = id || '';
        productName.value = product || '';
        // Images.value = images || '';
        Categories.value = categories || '';
        CostPrice.value = cost || '';
        SellingPrice.value = price || '';
        Size.value = size || "";

      
        modal.classList.remove('hidden');
    });
}

// Function to close modal
const closeFunction = () => {
    modal.classList.add('hidden');
};

// Close modal when close button is clicked
closeModal.addEventListener('click', closeFunction);
document.addEventListener('DOMContentLoaded', () => {
    // Your JavaScript code here
});