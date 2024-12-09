const consoleData = {
    ps4: {
        black: {
            image: "Consoles/PS4/PS4-black.webp",
            title: "Black PS4",
            price: "<del>£199.99</del> £99.99",
            descriptionHeading: "Product Description: Black PS4",
            description: "The black PlayStation 4 delivers cutting-edge graphics..."
        },
        white: {
            image: "Consoles/PS4/PS4-white.webp",
            title: "White PS4",
            price: "<del>£209.99</del> £109.99",
            descriptionHeading: "Product Description: White PS4",
            description: "The white PlayStation 4 offers a stunning combination..."
        },
        red: {
            image: "Consoles/PS4/PS4-red.webp",
            title: "Red PS4",
            price: "<del>£209.99</del> £109.99",
            descriptionHeading: "Product Description: Red PS4",
            description: "Make a bold statement with the red PlayStation 4..."
        }
    }
};

const cart = [];

const model = document.body.dataset.model || 'ps4';
const colourSelector = document.getElementById('colourselector');
const pname = document.getElementById('pname');
const pprice = document.getElementById('pprice');
const pdescription = document.getElementById('pdescription');
const pdescriptionHeading = document.getElementById('pdescriptionheading');
const addToCartButton = document.getElementById('addToCart');
const cartItems = document.getElementById('cart-items');
const totalPriceElement = document.getElementById('total-price');

// Function to update product info based on selected variant
function updateProductInfo(variant) {
    const product = consoleData[model][variant];
    document.getElementById('normal').src = product.image;
    pname.textContent = product.title;
    pprice.innerHTML = product.price;
    pdescriptionHeading.textContent = product.descriptionHeading;
    pdescription.textContent = product.description;
}

// Update product details when colour is selected
colourSelector.addEventListener("change", function () {
    const selectedColour = colourSelector.value.toLowerCase();
    updateProductInfo(selectedColour);
});

// Add product to cart
addToCartButton.addEventListener("click", function () {
    const selectedColour = colourSelector.value.toLowerCase();
    const product = consoleData[model][selectedColour];

    // Check if product already exists in the cart
    const existingItem = cart.find(item => item.title === product.title && item.colour === selectedColour);

    if (existingItem) {
        existingItem.quantity += 1; // Increase quantity if product is already in the cart
    } else {
        cart.push({
            title: product.title,
            price: product.price,
            colour: selectedColour,
            image: product.image,
            quantity: 1
        });
    }

    updateCart();
});

// Update the cart display
function updateCart() {
    cartItems.innerHTML = '';
    let totalPrice = 0;

    cart.forEach(item => {
        const li = document.createElement('li');
        li.innerHTML = `
            <img src="${item.image}" alt="${item.title}" width="50">
            <span>${item.title} - ${item.colour}</span>
            <input type="number" value="${item.quantity}" min="1" class="quantity" data-title="${item.title}" data-colour="${item.colour}">
            <button onclick="removeItem('${item.title}', '${item.colour}')">Remove</button>
        `;
        cartItems.appendChild(li);
        totalPrice += parseFloat(item.price.replace(/[^0-9.-]+/g, "")) * item.quantity;
    });

    totalPriceElement.textContent = totalPrice.toFixed(2);
}

// Remove item from cart
function removeItem(title, colour) {
    const index = cart.findIndex(item => item.title === title && item.colour === colour);
    if (index !== -1) {
        cart.splice(index, 1);
    }
    updateCart();
}

// Update item quantity in cart
cartItems.addEventListener('input', function (e) {
    if (e.target.classList.contains('quantity')) {
        const quantity = parseInt(e.target.value);
        const title = e.target.getAttribute('data-title');
        const colour = e.target.getAttribute('data-colour');

        const item = cart.find(item => item.title === title && item.colour === colour);
        if (item) {
            item.quantity = quantity;
        }
        updateCart();
    }
});
