document.addEventListener('DOMContentLoaded', () => {
    const itemsContainer = document.getElementById('items');
    const addItemForm = document.getElementById('addItemForm');

    // Load items from localStorage on page load
    loadItems();

    // Handle form submission
    addItemForm.addEventListener('submit', event => {
        event.preventDefault();
        const formData = new FormData(addItemForm);
        const item = {
            firstName: formData.get('first_name'),
            lastName: formData.get('last_name'),
            email: formData.get('email'),
            timestamp: Date.now()
        };
        addItem(item);
        addItemForm.reset();
    });

    function loadItems() {
        itemsContainer.innerHTML = '';
        const items = JSON.parse(localStorage.getItem('items')) || [];
        items.sort((a, b) => b.timestamp - a.timestamp);  // Sort items in descending order by timestamp
        items.forEach(item => {
            render(item);
        });
    }

    function render(item) {
        const itemElement = document.createElement('div');
        itemElement.classList.add('card', 'mt-2');
        itemElement.innerHTML = `
            <div class="card-body">
                <h5 class="card-title">${item.firstName} ${item.lastName}</h5>
                <p class="card-text">${item.email}</p>
            </div>
        `;
        itemsContainer.appendChild(itemElement);
    }

    function addItem(item) {
        const items = JSON.parse(localStorage.getItem('items')) || [];
        items.push(item);
        localStorage.setItem('items', JSON.stringify(items));
        loadItems();  // Reload items to apply sorting
    }
});
