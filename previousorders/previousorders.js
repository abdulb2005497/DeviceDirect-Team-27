document.addEventListener("DOMContentLoaded", () => {
    const tableBody = document.getElementById("orders-table-body");

    
    const mockOrders = [
        { product_name: "Wireless Mouse", quantity: 1, price: 20.00, order_date: "2024-11-15 14:30:00", status: "Delivered" },
        { product_name: "USB-C Hub", quantity: 2, price: 35.00, order_date: "2024-11-10 10:15:00", status: "Shipped" },
        { product_name: "Bluetooth Headphones", quantity: 1, price: 50.00, order_date: "2024-11-01 09:00:00", status: "Delivered" }
    ];

    // Function to render orders in the table
    function renderOrders(orders) {
        orders.forEach(order => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${order.product_name}</td>
                <td>${order.quantity}</td>
                <td>$${order.price.toFixed(2)}</td>
                <td>${new Date(order.order_date).toLocaleString()}</td>
                <td>${order.status}</td>
            `;

            tableBody.appendChild(row);
        });
    }

    // Call the function with mock data
    renderOrders(mockOrders);
});
