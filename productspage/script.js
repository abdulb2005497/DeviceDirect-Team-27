document.addEventListener('DOMContentLoaded', function () {
    fetchCategories(); 
    fetchProducts();
});

function fetchCategories() {
    fetch('fetchCategory.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(categories => {
            const categorySelect = document.getElementById('category-select');

            categorySelect.innerHTML = '<option value="">-- All Categories --</option>';

            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.category_id;
                option.textContent = category.category_name;
                categorySelect.appendChild(option);
            });


            categorySelect.addEventListener('change', function () {
                const categoryId = this.value;
                if (categoryId) {
                    fetchProductsByCategory(categoryId);
                } else {
                    fetchProducts();
                }
            });
        })
        .catch(error => {
            console.error('Error fetching categories:', error);
            document.getElementById('category-select').innerHTML = '<option value="">Error loading categories</option>';
        });
}

function fetchProducts() {
    fetch('fetchProdByCat.php?category_id=')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(products => {
            displayProducts(products);
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            document.getElementById('product-container').innerHTML = '<p>There was an error fetching products. Please try again later.</p>';
        });
}

function fetchProductsByCategory(categoryId) {
    fetch(`fetchProdByCat.php?category_id=${categoryId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(products => {
            displayProducts(products);
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            document.getElementById('product-container').innerHTML = '<p>There was an error fetching products. Please try again later.</p>';
        });
}

function displayProducts(products) {
    const productContainer = document.getElementById('product-container');
    productContainer.innerHTML = '';

    if (products.error) {
        productContainer.innerHTML = `<p>${products.error}</p>`;
    } else if (products.length === 0) {
        productContainer.innerHTML = `<p>No products found.</p>`;
    } else {
        products.forEach(product => {
            const productItem = document.createElement('div');
            productItem.classList.add('product-item');
            productItem.addEventListener('click', () => {
                window.location.href = `product-details.php?product_id=${product.product_id}`;
            });

            productItem.innerHTML = `
                <img src="images/${product.image}" alt="${product.product_title}">
                <h3>${product.product_title}</h3>
                <p>£${product.price}</p>
            `;

            productContainer.appendChild(productItem);
        });
    }
}
