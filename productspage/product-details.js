document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('product_id');

    if (productId) {
        fetchProductDetails(productId);
    } else {
        alert("Product ID is missing!");
    }
});

function fetchProductDetails(productId) {
    fetch(`fetchProductDetails.php?product_id=${productId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(product => {
            console.log('Product Details:', product);
            if (product && product.product_title && product.variants && Array.isArray(product.variants)) {
                displayProductDetails(product);
            } else {
                console.error('Product variants data is missing or invalid');
                document.getElementById('product-details-container').innerHTML = `<p>Product variants are missing or invalid.</p>`;
            }
        })
        .catch(error => {
            console.error('Error fetching product details:', error);
            document.getElementById('product-details-container').innerHTML = `<p>There was an error fetching the product details. Please try again later.</p>`;
        });
}

function displayProductDetails(product) {
    const container = document.getElementById('product-details-container');
    container.innerHTML = '';

    console.log("Display Product:", product);

    if (!product.product_title) {
        console.error('Product title is missing');
        container.innerHTML = `<p>Product title is missing.</p>`;
        return;
    }

    const productTitle = document.createElement('h2');
    productTitle.textContent = product.product_title;

    const productImage = document.createElement('img');
    productImage.src = `images/${product.variants[0].image}`;
    productImage.alt = product.product_title;

    const productDetails = document.createElement('div');
    productDetails.classList.add('details-container');

    productDetails.innerHTML = `
        <p><strong>Price:</strong> £${product.variants[0].price}</p>
        <p><strong>Description:</strong> ${product.variants[0].prod_desc}</p>
        <p><strong>Category:</strong> ${product.variants[0].category_name}</p>
    `;

    const colourSelector = document.createElement('select');
    colourSelector.innerHTML = '<option>Select Colour</option>';

    const uniqueColours = [...new Set(product.variants.map(variant => variant.colour_id))];

    uniqueColours.forEach(colourId => {
        const colourVariant = product.variants.find(variant => variant.colour_id === colourId);
        const option = document.createElement('option');
        option.value = colourVariant.colour_id;
        option.textContent = colourVariant.colour_name;
        colourSelector.appendChild(option);
    });

    const sizeSelector = document.createElement('select');
    sizeSelector.innerHTML = '<option>Select Size</option>';

    const uniqueSizes = [...new Set(product.variants.map(variant => variant.size_id))];

    uniqueSizes.forEach(sizeId => {
        const sizeVariant = product.variants.find(variant => variant.size_id === sizeId);
        const option = document.createElement('option');
        option.value = sizeVariant.size_id;
        option.textContent = sizeVariant.size_name;
        sizeSelector.appendChild(option);
    });

    const addToCartButton = document.createElement('button');
    addToCartButton.textContent = "Add to Cart";
    addToCartButton.classList.add('button');
    addToCartButton.disabled = true; // Disable button initially
    const cartMessage = document.createElement('p');
    cartMessage.classList.add('cart-message');

    container.appendChild(productTitle);
    container.appendChild(productImage);
    container.appendChild(productDetails);
    container.appendChild(colourSelector);
    container.appendChild(sizeSelector);
    container.appendChild(addToCartButton);
    container.appendChild(cartMessage);

    let selectedVariant = product.variants[0];


    colourSelector.addEventListener('change', function () {
        selectedVariant = product.variants.find(v => v.colour_id == colourSelector.value && v.size_id == sizeSelector.value);
        if (selectedVariant) {
            updateVariantDetails(selectedVariant, productImage, productDetails);
            addToCartButton.disabled = false;
        }
    });

    sizeSelector.addEventListener('change', function () {
        selectedVariant = product.variants.find(v => v.size_id == sizeSelector.value && v.colour_id == colourSelector.value);
        if (selectedVariant) {
            updateVariantDetails(selectedVariant, productImage, productDetails);
            addToCartButton.disabled = false;
        }
    });


    addToCartButton.addEventListener('click', function () {
        addToCart(selectedVariant);
        cartMessage.textContent = `Added ${selectedVariant.size_name} ${selectedVariant.colour_name} to your cart.`;
    });
}

function updateVariantDetails(variant, imageContainer, detailsContainer) {
    imageContainer.src = `images/${variant.image}`;
    imageContainer.alt = variant.colour_name;

    detailsContainer.innerHTML = `
        <p><strong>Price:</strong> £${variant.price}</p>
        <p><strong>Description:</strong> ${variant.prod_desc}</p>
        <p><strong>Category:</strong> ${variant.category_name}</p>
        <p><strong>Size:</strong> ${variant.size_name}</p>
    `;
}

function addToCart(variant) {
    console.log("Adding to cart: ", variant);
    const cartData = {
        prod_variant_id: variant.prod_variant_id,
        quantity: 1
    };

    fetch('../checkoutpage/add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(cartData)
    })
}
