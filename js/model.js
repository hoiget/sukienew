// Get elements
const modal = document.getElementById('modal');
const openModalBtn = document.querySelector('.open-modal-btn');
const closeModal = document.querySelector('.close-modal');

// Open modal
openModalBtn.addEventListener('click', () => {
    modal.style.display = 'flex'; // Show modal
});

// Close modal
closeModal.addEventListener('click', () => {
    modal.style.display = 'none'; // Hide modal
});

// Close modal when clicking outside the content
window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});
