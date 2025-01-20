document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll(".cake-checkbox");
    const totalPriceElement = document.getElementById("total-price");
    const whatsappButton = document.getElementById("whatsapp-button");
    const form = document.getElementById("cake-order-form");

    const cakePrices = [
        25.00, // Wedding Cake 1
        30.00, // Wedding Cake 2
        20.00, // Birthday Cake 1
        18.00, // Christmas Cake 1
        22.00, // Party Cake 1
        // Add more prices for additional cakes
    ];

    let totalPrice = 0;
    let selectedCakes = [];

    // Update total price when a checkbox is clicked
    checkboxes.forEach((checkbox, index) => {
        checkbox.addEventListener("change", function () {
            if (this.checked) {
                totalPrice += cakePrices[index];
                selectedCakes.push(checkbox.nextElementSibling.alt); // Push the cake name
            } else {
                totalPrice -= cakePrices[index];
                selectedCakes = selectedCakes.filter(cake => cake !== checkbox.nextElementSibling.alt);
            }
            totalPriceElement.textContent = totalPrice.toFixed(2); // Format to 2 decimal places
        });
    });

    // Send order to WhatsApp when the button is clicked
    whatsappButton.addEventListener("click", function () {
        if (selectedCakes.length > 0) {
            const cakesList = selectedCakes.join(', ');
            const orderMessage = `Hi, I would like to order the following cakes: ${cakesList}. Total Price: $${totalPrice.toFixed(2)}`;
            const whatsappURL = `https://wa.me/1234567890?text=${encodeURIComponent(orderMessage)}`; // Replace 1234567890 with your WhatsApp number
            window.open(whatsappURL, '_blank');
        } else {
            alert("Please select at least one cake before ordering.");
        }
    });
});
