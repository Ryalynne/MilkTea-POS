const modalButtons = document.getElementsByClassName('modalButtonUpdate');
const closeModal = document.getElementById('closeModal1');
const modal = document.getElementById('myModal1');


const Username = document.getElementById('name');
const Email = document.getElementById('email');
const Type = document.getElementById('user_type');
const User_ID = document.getElementById('User-ID');
// const recipe_id1 = document.getElementById('id');



// Loop through modalButtons and attach event listener to each
for (let i = 0; i < modalButtons.length; i++) {
    modalButtons[i].addEventListener('click', (event) => {
        const id = event.target.getAttribute('data-id');
        const name = event.target.getAttribute('data-name');
        const email = event.target.getAttribute('data-email');
        const type = event.target.getAttribute('data-type');


        Username.value = name || '';
        Type.value = type || '';
        Email.value = email || '';
        User_ID.value = id || '';

        // Add your logic to open the modal here
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