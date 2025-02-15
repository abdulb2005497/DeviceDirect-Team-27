document.addEventListener("DOMContentLoaded", function () {
    const colorSelect = document.getElementById("color-select");
    const productImage = document.getElementById("product-image");
    const productPrice = document.getElementById("product-price");
    const variantIdInput = document.getElementById("variant-id");

    if (!colorSelect || !productImage || !productPrice) {
        console.error("Error: Required elements not found.");
        return;
    }

    colorSelect.addEventListener("change", function () {
        const selectedOption = colorSelect.options[colorSelect.selectedIndex];

        if (!selectedOption) {
            console.error("Error: No option selected.");
            return;
        }

        // Fetch new price and image
        const newPrice = selectedOption.getAttribute("data-price");
        let newImage = selectedOption.getAttribute("data-image");
        const variantId = selectedOption.value;

        console.log("New Price from DB:", newPrice);
        console.log("New Image from DB:", newImage);

        // Validate price and update
        if (newPrice) {
            productPrice.textContent = `Price: £${parseFloat(newPrice).toFixed(2)}`;
        } else {
            console.warn("Warning: Price data missing.");
        }

        // Validate and update image
        if (!newImage || newImage.trim() === "" || newImage === "undefined") {
            newImage = "/images/default-placeholder.png";
            console.warn("Warning: No valid image found, using placeholder.");
        }

        // Check if image actually updates
        if (productImage.src !== window.location.origin + newImage) {
            productImage.src = newImage;
        }

        // Update hidden input for cart submission
        if (variantIdInput) {
            variantIdInput.value = variantId;
        }
    });
});
