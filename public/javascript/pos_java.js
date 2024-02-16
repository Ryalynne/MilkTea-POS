
// Get all elements with class modalButton
const modalButtons = document.getElementsByClassName('modalButton');
const closeModal = document.getElementById('closeModal');
const cancelButton = document.getElementById('cancelButton');
const modal = document.getElementById('myModal');

// Loop through modalButtons and attach event listener to each
for (let i = 0; i < modalButtons.length; i++) {
    modalButtons[i].addEventListener('click', () => {
        modal.classList.remove('hidden');
    });
}

// Function to close modal
const closeFunction = () => {
    modal.classList.add('hidden');
};

// Close modal when close button is clicked
closeModal.addEventListener('click', closeFunction);

// Close modal when cancel button is clicked
cancelButton.addEventListener('click', closeFunction);
