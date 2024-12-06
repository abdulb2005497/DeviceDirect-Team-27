document.addEventListener("DOMContentLoaded", () => {
    const tableBody = document.getElementById("orders-table-body");

    
    const mockOrders = [
        { product_name: "Console", 
        quantity: 1, 
        price: 520.00, 
        order_date: "2024-11-15 14:30:00", 
        status: "Delivered",
        stages: ["Ordered", "Processed", "Shipped", "Delivered"]  
    },
       
       
        { product_name: "TV", 
            quantity: 2, 
            price: 935.00, 
            order_date: "2024-11-10 10:15:00", 
            status: "Shipped",
            stages: ["Ordered", "Processed", "Shipped", "Delivered"]
        },
        
        
        { product_name:  "Headphones", 
            quantity: 1, 
            price: 50.00, 
            order_date: "2024-11-01 09:00:00", 
            status: "Delivered",
            stages: ["Ordered", "Processed", "Shipped", "Delivered"]
         }
    ];

     // Function to create progress bar
     function createProgressBar(stages, currentStatus) {
        const statusOrder = ["Ordered", "Processed", "Shipped", "Delivered"];
        const currentStageIndex = statusOrder.indexOf(currentStatus);

        const progressBarContainer = document.createElement("div");
        progressBarContainer.className = "progress-bar-container";

        const progressBar = document.createElement("div");
        progressBar.className = "progress-bar";

        // Calculate the width percentage
        const progressPercentage = ((currentStageIndex + 1) / stages.length) * 100;
        progressBar.style.width = `${progressPercentage}%`;

        // Create stage markers
        stages.forEach((stage, index) => {
            const marker = document.createElement("div");
            marker.className = `progress-marker ${index <= currentStageIndex ? 'completed' : ''}`;
            marker.textContent = stage;
            progressBarContainer.appendChild(marker);
        });

        progressBarContainer.appendChild(progressBar);
        return progressBarContainer;
    }

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
             // Create and append progress bar cell
             const progressCell = document.createElement("td");
             const progressBar = createProgressBar(order.stages, order.status);
             progressCell.appendChild(progressBar);
             row.appendChild(progressCell);
 
            tableBody.appendChild(row);
        });
    }

    // Call the function with mock data
    renderOrders(mockOrders);
});
