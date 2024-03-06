const modalButtons = document.getElementsByClassName('modalButtonUpdate');
const closeModal = document.getElementById('closeModal1');
const modal = document.getElementById('myModal1');


const id = document.getElementById('id');
const names = document.getElementById('name');


for (let i = 0; i < modalButtons.length; i++) {
    modalButtons[i].addEventListener('click', (event) => {

        const namee = event.target.getAttribute('data-name');
        const idd = event.target.getAttribute('data-id');

        id.value = idd || '';
        names.value = namee || '';

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