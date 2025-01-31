document.addEventListener("DOMContentLoaded", function () {
    const colorSelect = document.getElementById("color-select");
    const productImage = document.getElementById("product-image");
    const productPrice = document.getElementById("product-price");
    const variantIdInput = document.getElementById("variant-id");

    if (colorSelect) {
        colorSelect.addEventListener("change", function () {
            const selectedOption = colorSelect.options[colorSelect.selectedIndex];

            // Get data attributes
            const newPrice = selectedOption.getAttribute("data-price") || "0";
            let newImage = selectedOption.getAttribute("data-image");
            const variantId = selectedOption.value;

            console.log("New Image URL:", newImage);

            // Ensure newImage is valid and not empty
            if (!newImage || newImage.trim() === "" || newImage === "undefined") {
                newImage = "/images/default-placeholder.png";
            }

            // Only update if the new image is different from the current one
            if (productImage.src !== newImage) {
                const img = new Image();
                img.src = newImage;
                img.onload = function () {
                    productImage.src = newImage;
                };
                img.onerror = function () {
                    productImage.src = "/images/default-placeholder.png";
                };
            }

            // Update the price
            productPrice.textContent = `Price: £${parseFloat(newPrice).toFixed(2)}`;

            // Set hidden input for variant selection
            if (variantIdInput) {
                variantIdInput.value = variantId;
            }
        });
    }
});
